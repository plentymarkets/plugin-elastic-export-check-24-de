<?php

namespace ElasticExportCheck24DE\Generator;

use ElasticExport\Helper\ElasticExportCoreHelper;
use ElasticExport\Helper\ElasticExportPriceHelper;
use ElasticExport\Helper\ElasticExportStockHelper;
use ElasticExport\Services\FiltrationService;
use ElasticExport\Services\PriceDetectionService;
use ElasticExportCheck24DE\Helper\ManufacturerHelper;
use ElasticExportCheck24DE\Helper\StockHelper;
use Plenty\Modules\DataExchange\Contracts\CSVPluginGenerator;
use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Helper\Services\ArrayHelper;
use Plenty\Modules\DataExchange\Models\FormatSetting;
use Plenty\Modules\Item\Search\Contracts\VariationElasticSearchScrollRepositoryContract;
use Plenty\Modules\Item\Variation\Contracts\VariationExportServiceContract;
use Plenty\Modules\Item\Variation\Services\ExportPreloadValue\ExportPreloadValue;
use Plenty\Plugin\Log\Loggable;

/**
 * Class Check24DE
 * @package ElasticExportCheck24DE\Generator
 */
class Check24DE extends CSVPluginGenerator
{
    use Loggable;

    const CHECK24_DE = 150.00;
    const DELIMITER = "|"; // PIPE

	/** @var ElasticExportCoreHelper $elasticExportHelper */
	private $elasticExportHelper;

	/** @var StockHelper $stockHelper */
	private $stockHelper;

	/** @var ElasticExportPriceHelper $elasticExportPriceHelper */
	private $elasticExportPriceHelper;

	/** @var ArrayHelper $arrayHelper */
    private $arrayHelper;

    /** @var FiltrationService */
    private $filtrationService;

    /** @var ManufacturerHelper */
    private $manufacturerHelper;

    /** @var VariationExportServiceContract */
    private $variationExportService;

    /** @var PriceDetectionService */
    private $priceDetectionService;

    /** @var array */
    private $shippingCostCache;

	/**
	 * Check24DE constructor.
	 * @param ArrayHelper $arrayHelper
	 * @param ManufacturerHelper $manufacturerHelper
	 * @param VariationExportServiceContract $variationExportService
	 */
    public function __construct(ArrayHelper $arrayHelper, ManufacturerHelper $manufacturerHelper, VariationExportServiceContract $variationExportService)
    {
        $this->arrayHelper = $arrayHelper;
        $this->manufacturerHelper = $manufacturerHelper;

        $this->variationExportService = $variationExportService;
    }

    /**
     * Generates and populates the data into the CSV file.
     *
     * @param VariationElasticSearchScrollRepositoryContract $elasticSearch
     * @param array $formatSettings
     * @param array $filter
     */
    protected function generatePluginContent($elasticSearch, array $formatSettings = [], array $filter = [])
    {
        $this->variationExportService->addPreloadTypes([
            VariationExportServiceContract::SALES_PRICE,
            VariationExportServiceContract::STOCK
        ]);
        
        $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');

        $this->elasticExportHelper = pluginApp(ElasticExportCoreHelper::class);
        $this->elasticExportPriceHelper = pluginApp(ElasticExportPriceHelper::class);
        $this->stockHelper = pluginApp(StockHelper::class, ['settings' => $settings]);
		$this->filtrationService = pluginApp(FiltrationService::class, ['settings' => $settings, 'filterSettings' => $filter]);

        $this->priceDetectionService = pluginApp(PriceDetectionService::class);
		$this->priceDetectionService->preload($settings);

        $this->setDelimiter(self::DELIMITER);
        $this->addCSVContent($this->head());

        if($elasticSearch instanceof VariationElasticSearchScrollRepositoryContract) {
            // Initiate the counter for the variations limit
            $limitReached = false;
            $limit = 0;
            $elasticSearch->setNumberOfDocumentsPerShard(200);

            do {
                if($limitReached === true) {
                    break;
                }

                // Get the data from Elastic Search
                $resultList = $elasticSearch->execute();

                if(!empty($resultList['error'])) {
                    $this->getLogger(__METHOD__)
						->error('ElasticExportCheck24DE::logs.occurredElasticSearchErrors', ['message' => $resultList['error'],]);
                    break;
                }

                if(is_array($resultList['documents']) && count($resultList['documents']) > 0) {
                	$this->variationExportService->resetPreLoadedData();
                	$this->preloadExportServiceData($resultList['documents']);
                    $previousItemId = null;

                    foreach($resultList['documents'] as $variation) {
                        // Stop and set the flag if limit is reached
                        if($limit == $filter['limit']) {
                            $limitReached = true;
                            break;
                        }

                        // If filtered by stock is set and stock is negative, then skip the variation
                        if ($this->filtrationService->filter($variation)) {
                            continue;
                        }

                        try {
                            // Set the caches if we have the first variation or when we have the first variation of an item
                            if($previousItemId === null || $previousItemId != $variation['data']['item']['id']) {
                                $previousItemId = $variation['data']['item']['id'];
                                unset($this->shippingCostCache);

                                // Build the caches arrays
                                $this->buildCaches($variation, $settings);
                            }

                            // Build the new row for printing in the CSV file
								$this->buildRow($variation, $settings);
                        } catch(\Throwable $exception) {
                            $this->getLogger(__METHOD__)->error('ElasticExportCheck24DE::logs.fillRowError', [
                                'message' => $exception->getMessage(),
								'file' => $exception->getFile() . '::' . $exception->getLine(),
								'variationId' => $variation['id']
                            ]);
                        }

                        // New line was added
                        $limit++;
                    }
                }

            } while ($elasticSearch->hasNext());
        }
    }

    /**
     * Creates the header of the CSV file.
     *
     * @return array
     */
    private function head():array
    {
        return array(
            'id',
            'manufacturer',
            'mpnr',
            'ean',
            'name',
            'description',
            'category_path',
            'price',
            'price_per_unit',
            'link',
            'image_url',
            'delivery_time',
            'delivery_cost',
            'pzn',
            'stock',
            'weight',
        );
    }

    /**
     * Creates the variation row and prints it into the CSV file.
     *
     * @param $variation
     * @param KeyValue $settings
     */
    private function buildRow($variation, KeyValue $settings)
    {
		$price = $this->getPrice((int)$variation['id']);

        // Only variations with the Retail Price greater than zero will be handled
        if(strlen($price)) {
            $variationName = $this->elasticExportHelper->getAttributeValueSetShortFrontendName($variation, $settings);
			$imageList = $this->elasticExportHelper->getImageListInOrder($variation, $settings, 1, 'variationImages');

            $data = [
                'id'                => $this->elasticExportHelper->generateSku($variation['id'], self::CHECK24_DE, 0, (string)$variation['data']['skus'][0]['sku']),
                'manufacturer'      => $this->manufacturerHelper->getName((int)$variation['data']['item']['manufacturer']['id']),
                'mpnr'              => $variation['data']['variation']['model'],
                'ean'               => $this->elasticExportHelper->getBarcodeByType($variation, $settings->get('barcode')),
                'name'              => $this->elasticExportHelper->getMutatedName($variation, $settings) . (strlen($variationName) ? ' ' . $variationName : ''),
                'description'       => $this->elasticExportHelper->getMutatedDescription($variation, $settings),
                'category_path'     => $this->elasticExportHelper->getCategory((int)$variation['data']['defaultCategories'][0]['id'], $settings->get('lang'), $settings->get('plentyId')),
                'price'             => $price,
                'price_per_unit'    => $this->elasticExportPriceHelper->getBasePrice($variation, $price, $settings->get('lang')),
                'link'              => $this->elasticExportHelper->getMutatedUrl($variation, $settings, true, false),
                'image_url'         => $imageList[0],
                'delivery_time'     => $this->elasticExportHelper->getAvailability($variation, $settings, false),
                'delivery_cost'     => $this->getShippingCost($variation),
                'pzn'               => '',
                'stock'             => $this->getStock($variation),
                'weight'            => $variation['data']['variation']['weightG'],
            ];

            $this->addCSVContent(array_values($data));
        }
    }

    /**
     * Get the shipping cost.
     *
     * @param $variation
     * @return string
     */
    private function getShippingCost($variation):string
    {
        $shippingCost = null;
        if(isset($this->shippingCostCache) && array_key_exists($variation['data']['item']['id'], $this->shippingCostCache))
        {
            $shippingCost = $this->shippingCostCache[$variation['data']['item']['id']];
        }

        if(!is_null($shippingCost))
        {
            return number_format((float)$shippingCost, 2, '.', '');
        }

        return '';
    }

    /**
     * Build the cache arrays for the item variation.
     *
     * @param $variation
     * @param $settings
     */
    private function buildCaches($variation, $settings)
    {
        if(!is_null($variation) && !is_null($variation['data']['item']['id'])) {
            $shippingCost = $this->elasticExportHelper->getShippingCost($variation['data']['item']['id'], $settings);
            $this->shippingCostCache[$variation['data']['item']['id']] = (float)$shippingCost;
        }
    }

	/**
	 * Selects the first valid price for the variation and returns this formatted.
	 *
	 * @param int $variationId
	 * @return string
	 */
    private function getPrice(int $variationId):string
	{
		$preloadedPrices = $this->variationExportService->getData(VariationExportServiceContract::SALES_PRICE, $variationId);
		$priceData = $this->priceDetectionService->getPriceByPreloadList($preloadedPrices);
		$price = '';

		if (strlen($priceData['price']) && $priceData['price'] > 0) {
			$price = number_format($priceData['price'], 2);
		}

		return $price;
	}

	/**
	 * @param array $variation
	 * @return int
	 */
	private function getStock(array $variation):int
	{
		$preloadedStocks = $this->variationExportService->getData(VariationExportServiceContract::STOCK, $variation['id']);
		$stockNet = $this->stockHelper->calculateStock($variation, $preloadedStocks);
		return $stockNet;
	}

	/**
	 * Preloads the specified data for the variations of the current page.
	 *
	 * @param array $documents
	 */
	private function preloadExportServiceData(array $documents)
	{
		foreach ($documents as $variation) {
			$exportPreloadValue = pluginApp(ExportPreloadValue::class, [
				'itemId' => $variation['data']['item']['id'],
				'variationId' => $variation['id']
			]);

			$exportPreloadValues[] = $exportPreloadValue;
		}

		$this->variationExportService->preload($exportPreloadValues);
	}
}