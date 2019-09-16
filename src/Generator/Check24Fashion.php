<?php

namespace ElasticExportCheck24DE\Generator;

use ElasticExportCheck24DE\Helper\AttributeHelper;
use ElasticExportCheck24DE\Helper\SkuHelper;
use ElasticExport\Helper\ElasticExportCoreHelper;
use ElasticExport\Helper\ElasticExportCategoryHelper;
use ElasticExport\Helper\ElasticExportPriceHelper;
use ElasticExport\Helper\ElasticExportPropertyHelper;
use ElasticExport\Helper\ElasticExportItemHelper;
use ElasticExport\Services\FiltrationService;
use Plenty\Modules\DataExchange\Contracts\CSVPluginGenerator;
use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Helper\Services\ArrayHelper;
use Plenty\Modules\Item\Search\Contracts\VariationElasticSearchScrollRepositoryContract;
use Plenty\Plugin\Log\Loggable;

/**
 * Class Check24DE
 * @package ElasticExportCheck24DE\Generator
 */
class Check24Fashion extends CSVPluginGenerator
{
    use Loggable;

    const CHECK24_DE = 150.00;

    const DELIMITER = ";";

    const COLUMN_PRODUCT_NAME						= 'Produktname';
    const COLUMN_VARIATION_ID       				= 'Variation-ID';
    const COLUMN_MODEL_ID       					= 'Model-ID';
    const COLUMN_CATEGORY_PATH				        = 'Kategorie-Pfad';
    const COLUMN_SHORT_DESCRIPTION                  = 'Kurzbeschreibung';
    const COLUMN_DETAILED_DESCRIPTION               = 'Ausführliche Beschreibung';
    const COLUMN_AMAZON_SALES_RANK                  = 'Amazon Sales Rank';
    const COLUMN_RRP                                = 'Unverbindliche Preisempfehlung';
    const COLUMN_EAN                                = 'EAN';
    const COLUMN_ASIN                               = 'ASIN';
    const COLUMN_MPNR                               = 'MPNR';
    const COLUMN_SKU                                = 'SKU';
    const COLUMN_UPC                                = 'UPC';
    const COLUMN_IMAGE_URI_1                        = 'Bild-URL #1';
    const COLUMN_IMAGE_URI_2                        = 'Bild-URL #2';
    const COLUMN_IMAGE_URI_3                        = 'Bild-URL #3';
    const COLUMN_IMAGE_URI_4                        = 'Bild-URL #4';
    const COLUMN_IMAGE_URI_5                        = 'Bild-URL #5';
    const COLUMN_IMAGE_URI_6                        = 'Bild-URL #6';
    const COLUMN_IMAGE_URI_7                        = 'Bild-URL #7';
    const COLUMN_IMAGE_URI_8                        = 'Bild-URL #8';
    const COLUMN_IMAGE_URI_9                        = 'Bild-URL #9';
    const COLUMN_IMAGE_URI_10                       = 'Bild-URL #10';
    const COLUMN_IMAGE_URI_11                       = 'Bild-URL #11';
    const COLUMN_IMAGE_URI_12                       = 'Bild-URL #12';
    const COLUMN_IMAGE_URI_13                       = 'Bild-URL #13';
    const COLUMN_IMAGE_URI_14                       = 'Bild-URL #14';
    const COLUMN_IMAGE_URI_15                       = 'Bild-URL #15';
    const COLUMN_IMAGE_URI_16                       = 'Bild-URL #16';
    const COLUMN_IMAGE_URI_17                       = 'Bild-URL #17';
    const COLUMN_IMAGE_URI_18                       = 'Bild-URL #18';
    const COLUMN_IMAGE_URI_19                       = 'Bild-URL #19';
    const COLUMN_IMAGE_URI_20                       = 'Bild-URL #20';
    const COLUMN_TYPE_OF_HEEL                       = 'Absatzform';
    const COLUMN_TOE                                = 'Schuhspitze';
    const COLUMN_GENDER                             = 'Geschlecht';
    const COLUMN_AGE_GROUP                          = 'Altersgruppe';
    const COLUMN_SIZE                               = 'Größe';
    const COLUMN_SIZE_SYSTEM                        = 'Größensystem';
    const COLUMN_BRAND                              = 'Marke';
    const COLUMN_MATERIAL                           = 'Material';
    const COLUMN_LINING                             = 'Innenfutter';
    const COLUMN_HEEL_HEIGHT                        = 'Absatzhöhe';
    const COLUMN_SOLE_MATERIAL                      = 'Sohlenmaterial';
    const COLUMN_FIT                                = 'Passform';
    const COLUMN_FASTENER                           = 'Verschluss';
    const COLUMN_LEG_HEIGHT                         = 'Schafthöhe';
    const COLUMN_LEG_WIDTH                          = 'Schaftweite';
    const COLUMN_SHOE_WIDTH                         = 'Weite';
    const COLUMN_PATTERN                            = 'Muster';
    const COLUMN_MANUFACTURER_COLOR                 = 'Herstellerfarbe';
    const COLUMN_INSOLE                             = 'Innensohlenmaterial';
    const COLUMN_OCCASION                           = 'Anlass';
    const COLUMN_SEASON                             = 'Saison';
    const COLUMN_OTHER                              = 'Sonstige';
    const COLUMN_APPLIQUES                          = 'Applikationen';
    const COLUMN_FASHION_STYLE                      = 'Modestil';

    /**
     * @var ElasticExportCategoryHelper
     */
    private $elasticExportCategoryHelper;

    /**
     * @var ElasticExportCoreHelper $elasticExportHelper
     */
    private $elasticExportHelper;

    /**
     * @var ElasticExportPropertyHelper $elasticExportPropertyHelper
     */
    private $elasticExportPropertyHelper;

    /**
     * @var ElasticExportPriceHelper $elasticExportPriceHelper
     */
    private $elasticExportPriceHelper;

    /**
     * @var ElasticExportItemHelper
     */
    private $elasticExportItemHelper;

    /**
     * @var SkuHelper
     */
    private $skuHelper;
    
    /**
     * @var ArrayHelper $arrayHelper
     */
    private $arrayHelper;

    /**
     * @var AttributeHelper $attributeHelper
     */
    private $attributeHelper;

    /**
     * @var FiltrationService
     */
    private $filtrationService;

    /**
     * Check24DE constructor.
     *
     * @param ArrayHelper $arrayHelper
     */
    public function __construct(ArrayHelper $arrayHelper)
    {
        $this->arrayHelper = $arrayHelper;
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
        $this->elasticExportCategoryHelper = pluginApp(ElasticExportCategoryHelper::class);
        $this->elasticExportHelper = pluginApp(ElasticExportCoreHelper::class);
        $this->elasticExportPriceHelper = pluginApp(ElasticExportPriceHelper::class);
        $this->elasticExportPropertyHelper = pluginApp(ElasticExportPropertyHelper::class);
        $this->elasticExportItemHelper = pluginApp(ElasticExportItemHelper::class);
        $this->attributeHelper = pluginApp(AttributeHelper::class);
        $this->skuHelper = pluginApp(SkuHelper::class);

        $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');
        $this->filtrationService = pluginApp(FiltrationService::class, ['settings' => $settings, 'filterSettings' => $filter]);

        $this->setDelimiter(self::DELIMITER);

        $this->addCSVContent($this->head());

        if ($elasticSearch instanceof VariationElasticSearchScrollRepositoryContract) {
            // Initiate the counter for the variations limit
            $limitReached = false;
            $limit = 0;

            do {
                if ($limitReached === true) {
                    break;
                }

                // Get the data from Elastic Search
                $resultList = $elasticSearch->execute();

                if (count($resultList['error']) > 0) {
                    $this->getLogger(__METHOD__)->error('ElasticExportCheck24DE::logs.occurredElasticSearchErrors', [
                        'Error message' => $resultList['error'],
                    ]);
                    break;
                }

                if (is_array($resultList['documents']) && count($resultList['documents']) > 0) {
                    $previousItemId = null;

                    foreach ($resultList['documents'] as $variation) {
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
                            }

                            // Build the new row for printing in the CSV file
                            $this->buildRow($variation, $settings);
                        } catch(\Throwable $throwable) {
                            $this->getLogger(__METHOD__)->error('ElasticExportCheck24DE::logs.fillRowError', [
                                'Error message ' => $throwable->getMessage(),
                                'Error line'     => $throwable->getLine(),
                                'VariationId'    => $variation['id']
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
        return [
            self::COLUMN_PRODUCT_NAME,
            self::COLUMN_VARIATION_ID,
            self::COLUMN_MODEL_ID,
            self::COLUMN_CATEGORY_PATH,
            self::COLUMN_SHORT_DESCRIPTION,
            self::COLUMN_DETAILED_DESCRIPTION,
            self::COLUMN_AMAZON_SALES_RANK,
            self::COLUMN_RRP,
            self::COLUMN_EAN,
            self::COLUMN_ASIN,
            self::COLUMN_MPNR,
            self::COLUMN_SKU,
            self::COLUMN_UPC,
            self::COLUMN_IMAGE_URI_1,
            self::COLUMN_IMAGE_URI_2,
            self::COLUMN_IMAGE_URI_3,
            self::COLUMN_IMAGE_URI_4,
            self::COLUMN_IMAGE_URI_5,
            self::COLUMN_IMAGE_URI_6,
            self::COLUMN_IMAGE_URI_7,
            self::COLUMN_IMAGE_URI_8,
            self::COLUMN_IMAGE_URI_9,
            self::COLUMN_IMAGE_URI_10,
            self::COLUMN_IMAGE_URI_11,
            self::COLUMN_IMAGE_URI_12,
            self::COLUMN_IMAGE_URI_13,
            self::COLUMN_IMAGE_URI_14,
            self::COLUMN_IMAGE_URI_15,
            self::COLUMN_IMAGE_URI_16,
            self::COLUMN_IMAGE_URI_17,
            self::COLUMN_IMAGE_URI_18,
            self::COLUMN_IMAGE_URI_19,
            self::COLUMN_IMAGE_URI_20,
            self::COLUMN_TYPE_OF_HEEL,
            self::COLUMN_TOE,
            self::COLUMN_GENDER,
            self::COLUMN_AGE_GROUP,
            self::COLUMN_SIZE,
            self::COLUMN_SIZE_SYSTEM,
            self::COLUMN_BRAND,
            self::COLUMN_MATERIAL,
            self::COLUMN_LINING,
            self::COLUMN_HEEL_HEIGHT,
            self::COLUMN_SOLE_MATERIAL,
            self::COLUMN_FIT,
            self::COLUMN_FASTENER,
            self::COLUMN_LEG_HEIGHT,
            self::COLUMN_LEG_WIDTH,
            self::COLUMN_SHOE_WIDTH,
            self::COLUMN_PATTERN,
            self::COLUMN_MANUFACTURER_COLOR,
            self::COLUMN_INSOLE,
            self::COLUMN_OCCASION,
            self::COLUMN_SEASON,
            self::COLUMN_OTHER,
            self::COLUMN_APPLIQUES,
            self::COLUMN_FASHION_STYLE
        ];
    }

    /**
     * Creates the variation row and prints it into the CSV file.
     *
     * @param $variation
     * @param KeyValue $settings
     */
    private function buildRow($variation, KeyValue $settings)
    {
        // Get the price
        $recommendedRetailPriceInformation = $this->elasticExportPriceHelper->getRecommendedRetailPriceInformation($variation, $settings);
        
        // Set SKU information
        $this->skuHelper->setSku($variation, self::CHECK24_DE, (int) $settings->get('marketAccountId'));
        
        if (isset($variation['data']['attributes']) && is_array($variation['data']['attributes'])) {
            $this->attributeHelper->addToAttributeLinkCache($variation['data']['attributes']);
            $colorAttributeValueId = $this->attributeHelper->getTargetAttributeValueId($variation['data']['attributes'], self::COLUMN_MANUFACTURER_COLOR);
        }
        
        // Get images
        $imageList = $this->getImages($variation);

        $lang = $settings->get('lang');
        
        $data = [
            self::COLUMN_PRODUCT_NAME =>
                $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_PRODUCT_NAME),
            self::COLUMN_VARIATION_ID =>
                isset($colorAttributeValueId) ? $variation['data']['skus'][0]['parentSku'].'-'.$colorAttributeValueId : $variation['data']['skus'][0]['parentSku'],
            self::COLUMN_MODEL_ID =>
                $variation['data']['skus'][0]['parentSku'],
            self::COLUMN_CATEGORY_PATH =>
                $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_CATEGORY_PATH),
            self::COLUMN_SHORT_DESCRIPTION =>
                $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_SHORT_DESCRIPTION),
            self::COLUMN_DETAILED_DESCRIPTION =>
                $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_DETAILED_DESCRIPTION),
            self::COLUMN_AMAZON_SALES_RANK =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_AMAZON_SALES_RANK, self::CHECK24_DE, $lang),
            self::COLUMN_RRP =>
                $recommendedRetailPriceInformation['price'] > 0.00 ? $recommendedRetailPriceInformation['price'] : '',
            self::COLUMN_EAN =>
                $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_EAN),
            self::COLUMN_ASIN =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_ASIN, self::CHECK24_DE, $lang),
            self::COLUMN_MPNR =>
                $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_MPNR),
            self::COLUMN_SKU =>
                $variation['data']['skus'][0]['sku'],
            self::COLUMN_UPC =>
                $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_UPC),
            self::COLUMN_IMAGE_URI_1 => isset($imageList[0]['url']) ? $imageList[0]['url'] : '',
            self::COLUMN_IMAGE_URI_2 => isset($imageList[1]['url']) ? $imageList[1]['url'] : '',
            self::COLUMN_IMAGE_URI_3 => isset($imageList[2]['url']) ? $imageList[2]['url'] : '',
            self::COLUMN_IMAGE_URI_4 => isset($imageList[3]['url']) ? $imageList[3]['url'] : '',
            self::COLUMN_IMAGE_URI_5 => isset($imageList[4]['url']) ? $imageList[4]['url'] : '',
            self::COLUMN_IMAGE_URI_6 => isset($imageList[5]['url']) ? $imageList[5]['url'] : '',
            self::COLUMN_IMAGE_URI_7 => isset($imageList[6]['url']) ? $imageList[6]['url'] : '',
            self::COLUMN_IMAGE_URI_8 => isset($imageList[7]['url']) ? $imageList[7]['url'] : '',
            self::COLUMN_IMAGE_URI_9 => isset($imageList[8]['url']) ? $imageList[8]['url'] : '',
            self::COLUMN_IMAGE_URI_10 => isset($imageList[9]['url']) ? $imageList[9]['url'] : '',
            self::COLUMN_IMAGE_URI_11 => isset($imageList[10]['url']) ? $imageList[10]['url'] : '',
            self::COLUMN_IMAGE_URI_12 => isset($imageList[11]['url']) ? $imageList[11]['url'] : '',
            self::COLUMN_IMAGE_URI_13 => isset($imageList[12]['url']) ? $imageList[12]['url'] : '',
            self::COLUMN_IMAGE_URI_14 => isset($imageList[13]['url']) ? $imageList[13]['url'] : '',
            self::COLUMN_IMAGE_URI_15 => isset($imageList[14]['url']) ? $imageList[14]['url'] : '',
            self::COLUMN_IMAGE_URI_16 => isset($imageList[15]['url']) ? $imageList[15]['url'] : '',
            self::COLUMN_IMAGE_URI_17 => isset($imageList[16]['url']) ? $imageList[16]['url'] : '',
            self::COLUMN_IMAGE_URI_18 => isset($imageList[17]['url']) ? $imageList[17]['url'] : '',
            self::COLUMN_IMAGE_URI_19 => isset($imageList[18]['url']) ? $imageList[18]['url'] : '',
            self::COLUMN_IMAGE_URI_20 => isset($imageList[19]['url']) ? $imageList[19]['url'] : '',
            self::COLUMN_TYPE_OF_HEEL =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_TYPE_OF_HEEL, self::CHECK24_DE, $lang),
            self::COLUMN_TOE =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_TOE, self::CHECK24_DE, $lang),
            self::COLUMN_GENDER =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_GENDER, self::CHECK24_DE, $lang),
            self::COLUMN_AGE_GROUP =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_AGE_GROUP, self::CHECK24_DE, $lang),
            self::COLUMN_SIZE =>
                $this->getPropertyOrAttribute($variation, self::COLUMN_SIZE, $settings),
            self::COLUMN_SIZE_SYSTEM =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_SIZE_SYSTEM, self::CHECK24_DE, $lang),
            self::COLUMN_BRAND =>
                $this->getPropertyOrRegularData($variation, $settings, self::COLUMN_BRAND),
            self::COLUMN_MATERIAL =>
                $this->getPropertyOrAttribute($variation, self::COLUMN_MATERIAL, $settings),
            self::COLUMN_LINING =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_LINING, self::CHECK24_DE, $lang),
            self::COLUMN_HEEL_HEIGHT =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_HEEL_HEIGHT, self::CHECK24_DE, $lang),
            self::COLUMN_SOLE_MATERIAL =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_SOLE_MATERIAL, self::CHECK24_DE, $lang),
            self::COLUMN_FIT =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_FIT, self::CHECK24_DE, $lang),
            self::COLUMN_FASTENER =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_FASTENER, self::CHECK24_DE, $lang),
            self::COLUMN_LEG_HEIGHT =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_LEG_HEIGHT, self::CHECK24_DE, $lang),
            self::COLUMN_LEG_WIDTH =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_LEG_WIDTH, self::CHECK24_DE, $lang),
            self::COLUMN_SHOE_WIDTH =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_SHOE_WIDTH, self::CHECK24_DE, $lang),
            self::COLUMN_PATTERN =>
                $this->getPropertyOrAttribute($variation, self::COLUMN_PATTERN, $settings),
            self::COLUMN_MANUFACTURER_COLOR  =>
                $this->getPropertyOrAttribute($variation, self::COLUMN_MANUFACTURER_COLOR, $settings),
            self::COLUMN_INSOLE =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_INSOLE, self::CHECK24_DE, $lang),
            self::COLUMN_OCCASION =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_OCCASION, self::CHECK24_DE, $lang),
            self::COLUMN_SEASON =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_SEASON, self::CHECK24_DE, $lang),
            self::COLUMN_OTHER =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_OTHER, self::CHECK24_DE, $lang),
            self::COLUMN_APPLIQUES =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_APPLIQUES, self::CHECK24_DE, $lang),
            self::COLUMN_FASHION_STYLE =>
                $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_FASHION_STYLE, self::CHECK24_DE, $lang),
        ];

        $this->addCSVContent(array_values($data));
    }

    /**
     * @param array $variation
     * @param KeyValue $settings
     * @param string $targetColumn
     * @return string
     */
    private function getPropertyOrRegularData(array $variation, KeyValue $settings, string $targetColumn):string
    {
        $value = $this->elasticExportPropertyHelper->getProperty($variation, $targetColumn, self::CHECK24_DE, $settings->get('lang'));

        if (!strlen($value)) {
            switch ($targetColumn) {
                case self::COLUMN_PRODUCT_NAME:
                    return $this->elasticExportHelper->getMutatedName($variation, $settings);
                case self::COLUMN_CATEGORY_PATH:
                    return $this->elasticExportCategoryHelper->getCategoryPath((int)$variation['data']['defaultCategories'][0]['id'], $settings);
                case self::COLUMN_SHORT_DESCRIPTION:
                    return $this->elasticExportHelper->getMutatedPreviewText($variation, $settings);
                case self::COLUMN_DETAILED_DESCRIPTION:
                    return $this->elasticExportHelper->getMutatedDescription($variation, $settings);
                case self::COLUMN_EAN:
                    return $this->elasticExportHelper->getBarcodeByType($variation, $settings->get('barcode'));
                case self::COLUMN_MPNR:
                    return $variation['data']['variation']['model'];
                case self::COLUMN_UPC:
                    return $this->elasticExportHelper->getBarcodeByType($variation, ElasticExportCoreHelper::BARCODE_UPC);
                case self::COLUMN_BRAND:
                    return $this->elasticExportItemHelper->getExternalManufacturerName($variation);
            }
        }

        return $value;
    }

    /**
     * @param array $variation
     * @param string $targetColumn
     * @param KeyValue $settings
     * @return string
     */
    private function getPropertyOrAttribute(array $variation, string $targetColumn, KeyValue $settings):string
    {
        $value = '';
        if (isset($variation['data']['attributes']) && is_array($variation['data']['attributes'])) {
            $value = $this->attributeHelper->getTargetAttributeValue($variation['data']['attributes'], $targetColumn);
        }
        if (!strlen($value)) {
            $value = $this->elasticExportPropertyHelper->getProperty($variation, $targetColumn, self::CHECK24_DE, $settings->get('lang'));
        }
        return $value;
    }

    /**
     * @param array $variation
     * @return array
     */
    private function getImages(array $variation):array
    {
        $imageList = [];
        
        if (isset($variation['data']['images']['variation']) &&
            is_array($variation['data']['images']['variation']) &&
            count($variation['data']['images']['variation']))
        {
            $imageList = $variation['data']['images']['variation'];
        } elseif (isset($variation['data']['images']['all']) &&
                  is_array($variation['data']['images']['all']) &&
                  count($variation['data']['images']['all']))
        {
            $imageList = $variation['data']['images']['all'];
        }

        if (count($imageList)) {
            usort($imageList, function($a, $b) {
                return $a['position'] <=> $b['position'];
            });
        }
        
        return $imageList;
    }
}