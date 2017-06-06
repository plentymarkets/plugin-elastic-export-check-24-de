<?php

namespace ElasticExportCheck24DE\Generator;

use ElasticExport\Helper\ElasticExportCoreHelper;
use ElasticExport\Helper\ElasticExportStockHelper;
use ElasticExportCheck24DE\Helper\PriceHelper;
use ElasticExportCheck24DE\Helper\StockHelper;
use Plenty\Modules\DataExchange\Contracts\CSVPluginGenerator;
use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Helper\Services\ArrayHelper;
use Plenty\Modules\DataExchange\Models\FormatSetting;
use Plenty\Modules\Item\Search\Contracts\VariationElasticSearchScrollRepositoryContract;
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

    /**
     * @var ElasticExportCoreHelper $elasticExportHelper
     */
    private $elasticExportHelper;

    /**
     * @var ElasticExportStockHelper $elasticExportStockHelper
     */
    private $elasticExportStockHelper;

    /**
     * @var ArrayHelper $arrayHelper
     */
    private $arrayHelper;

    /**
     * @var PriceHelper
     */
    private $priceHelper;

    /**
     * @var StockHelper
     */
    private $stockHelper;

    /**
     * @var array
     */
    private $shippingCostCache;

    /**
     * @var array
     */
    private $manufacturerCache;

    /**
     * Check24DE constructor.
     *
     * @param ArrayHelper $arrayHelper
     */
    public function __construct(
        ArrayHelper $arrayHelper,
        PriceHelper $priceHelper,
        StockHelper $stockHelper)
    {
        $this->arrayHelper = $arrayHelper;
        $this->priceHelper = $priceHelper;
        $this->stockHelper = $stockHelper;
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
        $this->elasticExportStockHelper = pluginApp(ElasticExportStockHelper::class);
        $this->elasticExportHelper = pluginApp(ElasticExportCoreHelper::class);

        $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');

        $this->setDelimiter(self::DELIMITER);

        $this->addCSVContent($this->head());

        $startTime = microtime(true);

        if($elasticSearch instanceof VariationElasticSearchScrollRepositoryContract)
        {
            // Initiate the counter for the variations limit
            $limitReached = false;
            $limit = 0;

            do
            {
                $this->getLogger(__METHOD__)->debug('ElasticExportCheck24DE::logs.writtenLines', [
                    'Lines written' => $limit,
                ]);

                if($limitReached === true)
                {
                    break;
                }

                $esStartTime = microtime(true);

                // Get the data from Elastic Search
                $resultList = $elasticSearch->execute();

                $this->getLogger(__METHOD__)->debug('ElasticExportCheck24DE::logs.esDuration', [
                    'Elastic Search duration' => microtime(true) - $esStartTime,
                ]);

                if(count($resultList['error']) > 0)
                {
                    $this->getLogger(__METHOD__)->error('ElasticExportCheck24DE::logs.occurredElasticSearchErrors', [
                        'Error message' => $resultList['error'],
                    ]);

                    break;
                }

                $buildRowStartTime = microtime(true);

                if(is_array($resultList['documents']) && count($resultList['documents']) > 0)
                {
                    $previousItemId = null;

                    foreach($resultList['documents'] as $variation)
                    {
                        // Stop and set the flag if limit is reached
                        if($limit == $filter['limit'])
                        {
                            $limitReached = true;
                            break;
                        }

                        // If filtered by stock is set and stock is negative, then skip the variation
                        if ($this->elasticExportStockHelper->isFilteredByStock($variation, $filter) === true)
                        {
                            $this->getLogger(__METHOD__)->info('ElasticExportCheck24DE::logs.variationNotPartOfExportStock', [
                                'VariationId' => $variation['id']
                            ]);

                            continue;
                        }

                        try
                        {
                            // Set the caches if we have the first variation or when we have the first variation of an item
                            if($previousItemId === null || $previousItemId != $variation['data']['item']['id'])
                            {
                                $previousItemId = $variation['data']['item']['id'];
                                unset($this->shippingCostCache, $this->manufacturerCache);

                                // Build the caches arrays
                                $this->buildCaches($variation, $settings);
                            }

                            // Build the new row for printing in the CSV file
                            $this->buildRow($variation, $settings);
                        }
                        catch(\Throwable $throwable)
                        {
                            $this->getLogger(__METHOD__)->error('ElasticExportCheck24DE::logs.fillRowError', [
                                'Error message ' => $throwable->getMessage(),
                                'Error line'     => $throwable->getLine(),
                                'VariationId'    => $variation['id']
                            ]);
                        }

                        // New line was added
                        $limit++;
                    }

                    $this->getLogger(__METHOD__)->debug('ElasticExportCheck24DE::logs.buildRowDuration', [
                        'Build rows duration' => microtime(true) - $buildRowStartTime,
                    ]);
                }

            } while ($elasticSearch->hasNext());
        }

        $this->getLogger(__METHOD__)->debug('ElasticExportCheck24DE::logs.fileGenerationDuration', [
            'Whole file generation duration' => microtime(true) - $startTime,
        ]);
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
            'weight'
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
        // get the price
        $price = $this->priceHelper->getPrice($variation, $settings);

        // only variations with the Retail Price greater than zero will be handled
        if(!is_null($price['variationRetailPrice.price']) && $price['variationRetailPrice.price'] > 0)
        {
            $variationName = $this->elasticExportHelper->getAttributeValueSetShortFrontendName($variation, $settings);

            $shippingCost = $this->getShippingCost($variation);

            $manufacturer = $this->getManufacturer($variation);

            $stock = $this->stockHelper->getStock($variation);

            $data = [
                'id' 				=> $this->getSku($variation),
                'manufacturer' 		=> $manufacturer,
                'mpnr' 				=> $variation['data']['variation']['model'],
                'ean' 				=> $this->elasticExportHelper->getBarcodeByType($variation, $settings->get('barcode')),
                'name' 				=> $this->elasticExportHelper->getMutatedName($variation, $settings) . (strlen($variationName) ? ' ' . $variationName : ''),
                'description' 		=> $this->elasticExportHelper->getMutatedDescription($variation, $settings),
                'category_path' 	=> $this->elasticExportHelper->getCategory((int)$variation['data']['defaultCategories'][0]['id'], $settings->get('lang'), $settings->get('plentyId')),
                'price' 			=> number_format((float)$price['variationRetailPrice.price'], 2, '.', ''),
                'price_per_unit'	=> $this->elasticExportHelper->getBasePrice($variation, $price, $settings->get('lang')),
                'link' 				=> $this->elasticExportHelper->getMutatedUrl($variation, $settings, true, false),
                'image_url'			=> $this->elasticExportHelper->getMainImage($variation, $settings),
                'delivery_time' 	=> $this->elasticExportHelper->getAvailability($variation, $settings, false),
                'delivery_cost' 	=> $shippingCost,
                'pzn' 				=> '',
                'stock' 			=> $stock,
                'weight' 			=> $variation['data']['variation']['weightG']
            ];

            $this->addCSVContent(array_values($data));
        }
        else
        {
            $this->getLogger(__METHOD__)->info('ElasticExportCheck24DE::logs.variationNotPartOfExportPrice', [
                'VariationId' => $variation['id']
            ]);
        }
    }

    /**
     * Get the SKU.
     *
     * @param  array $variation
     * @return string
     */
    private function getSku($variation):string
    {
        if(!is_null($variation['data']['skus'][0]['sku']) && strlen($variation['data']['skus'][0]['sku']) > 0)
        {
            return $variation['data']['skus'][0]['sku'];
        }

        return $this->elasticExportHelper->generateSku($variation['id'], self::CHECK24_DE, 0, (string)$variation['id']);
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
            $shippingCost = number_format((float)$shippingCost, 2, '.', '');
            return $shippingCost;
        }

        return '';
    }

    /**
     * Get the manufacturer name.
     *
     * @param $variation
     * @return string
     */
    private function getManufacturer($variation):string
    {
        if(isset($this->manufacturerCache) && array_key_exists($variation['data']['item']['id'], $this->manufacturerCache))
        {
            return $this->manufacturerCache[$variation['data']['item']['id']];
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
        if(!is_null($variation) && !is_null($variation['data']['item']['id']))
        {
            $this->shippingCostCache[$variation['data']['item']['id']] = $this->elasticExportHelper->getShippingCost($variation['data']['item']['id'], $settings, 0);

            $this->manufacturerCache[$variation['data']['item']['id']] = $this->elasticExportHelper->getExternalManufacturerName((int)$variation['data']['item']['manufacturer']['id']);
        }
    }
}