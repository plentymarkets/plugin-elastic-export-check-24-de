<?php

namespace ElasticExportCheck24DE\Generator;

use ElasticExportCheck24DE\Helper\AttributeHelper;
use ElasticExport\Helper\ElasticExportCoreHelper;
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
    const COLUMN_CATEGORY_ID				        = 'Kategorie-ID';
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
    const COLUMN_TYPE_OF_HEEL                       = '(Attribut) Absatzform';
    const COLUMN_TOE                                = '(Attribut) Schuhspitze';
    const COLUMN_COLOR                              = '(Attribut) Farbe';
    const COLUMN_GENDER                             = '(Attribut) Geschlecht';
    const COLUMN_AGE_GROUP                          = '(Attribut) Altersgruppe';
    const COLUMN_SIZE                               = '(Attribut) Größe';
    const COLUMN_SIZE_SYSTEM                        = '(Attribut) Größensystem';
    const COLUMN_BRAND                              = '(Attribut) Marke';
    const COLUMN_MATERIAL                           = '(Attribut) Material';
    const COLUMN_LINING                             = '(Attribut) Innenfutter';
    const COLUMN_HEEL_HEIGHT                        = '(Attribut) Absatzhöhe';
    const COLUMN_SOLE_MATERIAL                      = '(Attribut) Sohlenmaterial';
    const COLUMN_FIT                                = '(Attribut) Passform';
    const COLUMN_FASTENER                           = '(Attribut) Verschluss';
    const COLUMN_LEG_HEIGHT                         = '(Attribut) Schafthöhe';
    const COLUMN_LEG_WIDTH                          = '(Attribut) Schaftweite';
    const COLUMN_SHOE_WIDTH                         = '(Attribut) Weite';
    const COLUMN_PATTERN                            = '(Attribut) Muster';
    const COLUMN_MANUFACTURER_COLOR                 = '(Attribut) Herstellerfarbe';
    const COLUMN_INSOLE                             = '(Attribut) Innensohlenmaterial';
    const COLUMN_OCCASION                           = '(Tag) Anlass';
    const COLUMN_SEASON                             = '(Tag) Saison';
    const COLUMN_OTHER                              = '(Tag) Sonstige';
    const COLUMN_APPLIQUES                          = '(Tag) Applikationen';
    const COLUMN_FASHION_STYLE                      = '(Tag) Modestil';


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
        $this->elasticExportHelper = pluginApp(ElasticExportCoreHelper::class);
        $this->elasticExportPriceHelper = pluginApp(ElasticExportPriceHelper::class);
        $this->elasticExportPropertyHelper = pluginApp(ElasticExportPropertyHelper::class);
        $this->elasticExportItemHelper = pluginApp(ElasticExportItemHelper::class);
        $this->attributeHelper = pluginApp(AttributeHelper::class);

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
            self::COLUMN_CATEGORY_ID,
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
            self::COLUMN_TYPE_OF_HEEL,
            self::COLUMN_TOE,
            self::COLUMN_COLOR,
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
        $imageList = $this->elasticExportHelper->getImageListInOrder($variation, $settings, 10, 'variationImages');

        if (isset($variation['data']['attributes']) && is_array($variation['data']['attributes'])) {
            $this->attributeHelper->addToAttributeLinkCache($variation['data']['attributes']);
        }

        $data = [
            self::COLUMN_PRODUCT_NAME => $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_PRODUCT_NAME),
            self::COLUMN_VARIATION_ID => $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_VARIATION_ID),
            self::COLUMN_MODEL_ID => $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_MODEL_ID),
            self::COLUMN_CATEGORY_ID => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_CATEGORY_ID, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_SHORT_DESCRIPTION => $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_SHORT_DESCRIPTION),
            self::COLUMN_DETAILED_DESCRIPTION => $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_DETAILED_DESCRIPTION),
            self::COLUMN_AMAZON_SALES_RANK => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_AMAZON_SALES_RANK, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_RRP => $recommendedRetailPriceInformation['price'] > 0.00 ? $recommendedRetailPriceInformation['price'] : '',
            self::COLUMN_EAN => $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_EAN),
            self::COLUMN_ASIN => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_ASIN, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_MPNR => $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_MPNR),
            self::COLUMN_SKU => $this->elasticExportHelper->generateSku($variation['id'], self::CHECK24_DE, 0, $variation['data']['skus']['sku']),
            self::COLUMN_UPC => $this->getPropertyOrRegularData($variation, $settings,self::COLUMN_UPC),
            self::COLUMN_IMAGE_URI_1 => $imageList[0],
            self::COLUMN_IMAGE_URI_2 => $imageList[1],
            self::COLUMN_IMAGE_URI_3 => $imageList[2],
            self::COLUMN_IMAGE_URI_4 => $imageList[3],
            self::COLUMN_IMAGE_URI_5 => $imageList[4],
            self::COLUMN_IMAGE_URI_6 => $imageList[5],
            self::COLUMN_IMAGE_URI_7 => $imageList[6],
            self::COLUMN_IMAGE_URI_8 => $imageList[7],
            self::COLUMN_IMAGE_URI_9 => $imageList[8],
            self::COLUMN_IMAGE_URI_10 => $imageList[9],
            self::COLUMN_TYPE_OF_HEEL => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_TYPE_OF_HEEL, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_TOE => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_TOE, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_COLOR => $this->getPropertyOrAttribute($variation, self::COLUMN_COLOR, $settings),
            self::COLUMN_GENDER => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_GENDER, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_AGE_GROUP => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_AGE_GROUP, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_SIZE => $this->getPropertyOrAttribute($variation, self::COLUMN_SIZE, $settings),
            self::COLUMN_SIZE_SYSTEM => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_SIZE_SYSTEM, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_BRAND => $this->elasticExportItemHelper->getExternalManufacturerName($variation),
            self::COLUMN_MATERIAL => $this->getPropertyOrAttribute($variation, self::COLUMN_MATERIAL, $settings),
            self::COLUMN_LINING => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_LINING, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_HEEL_HEIGHT => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_HEEL_HEIGHT, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_SOLE_MATERIAL => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_SOLE_MATERIAL, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_FIT => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_FIT, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_FASTENER => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_FASTENER, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_LEG_HEIGHT => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_LEG_HEIGHT, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_LEG_WIDTH => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_LEG_WIDTH, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_SHOE_WIDTH => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_SHOE_WIDTH, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_PATTERN => $this->getPropertyOrAttribute($variation, self::COLUMN_PATTERN, $settings),
            self::COLUMN_MANUFACTURER_COLOR  => $this->getPropertyOrAttribute($variation, self::COLUMN_MANUFACTURER_COLOR, $settings),
            self::COLUMN_INSOLE => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_INSOLE, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_OCCASION => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_OCCASION, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_SEASON => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_SEASON, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_OTHER => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_OTHER, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_APPLIQUES => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_APPLIQUES, self::CHECK24_DE, $settings->get('lang')),
            self::COLUMN_FASHION_STYLE => $this->elasticExportPropertyHelper->getProperty($variation, self::COLUMN_FASHION_STYLE, self::CHECK24_DE, $settings->get('lang')),
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
                case self::COLUMN_VARIATION_ID:
                    return $variation['id'];
                case self::COLUMN_MODEL_ID:
                    return $variation['data']['variation']['number'];
                case self::COLUMN_PRODUCT_NAME:
                    return $this->elasticExportHelper->getMutatedName($variation, $settings);
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
}