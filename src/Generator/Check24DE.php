<?php

namespace ElasticExportCheck24DE\Generator;

use ElasticExport\Helper\ElasticExportCoreHelper;
use Plenty\Modules\DataExchange\Contracts\CSVGenerator;
use Plenty\Modules\Helper\Services\ArrayHelper;
use Plenty\Modules\Item\DataLayer\Models\Record;
use Plenty\Modules\Item\DataLayer\Models\RecordList;
use Plenty\Modules\DataExchange\Models\FormatSetting;

class Check24DE extends CSVGenerator
{
    const CHECK24_DE = 150.00;

    /**
     * @var ElasticExportCoreHelper $elasticExportHelper
     */
    private $elasticExportHelper;

    /**
     * @var ArrayHelper $arrayHelper
     */
    private $arrayHelper;

    /**
     * @var array $idlVariations
     */
    private $idlVariations = array();

    /**
     * Billiger constructor.
     * @param ArrayHelper $arrayHelper
     */
    public function __construct(ArrayHelper $arrayHelper)
    {
        $this->arrayHelper = $arrayHelper;
    }

    /**
     * @param array $resultData
     * @param array $formatSettings
     */
    protected function generateContent($resultData, array $formatSettings = [])
    {
        $this->elasticExportHelper = pluginApp(ElasticExportCoreHelper::class);
        if(is_array($resultData['documents']) && count($resultData['documents']) > 0)
        {
            $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');

            $this->setDelimiter("|");

            $this->addCSVContent([
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
            ]);

            //Create a List of all VariationIds
            $variationIdList = array();
            foreach($resultData['documents'] as $variation)
            {
                $variationIdList[] = $variation['id'];
            }

            //Get the missing fields in ES from IDL
            if(is_array($variationIdList) && count($variationIdList) > 0)
            {
                /**
                 * @var \ElasticExportCheck24DE\IDL_ResultList\Check24DE $idlResultList
                 */
                $idlResultList = pluginApp(\ElasticExportRakutenDE\IDL_ResultList\RakutenDE::class);
                $idlResultList = $idlResultList->getResultList($variationIdList, $settings);
            }

            //Creates an array with the variationId as key to surpass the sorting problem
            if(isset($idlResultList) && $idlResultList instanceof RecordList)
            {
                $this->createIdlArray($idlResultList);
            }

            foreach($resultData['documents'] as $item)
            {
                $variationName = $this->elasticExportHelper->getAttributeValueSetShortFrontendName($item, $settings);

                $shippingCost = $this->elasticExportHelper->getShippingCost($item['data']['item']['id'], $settings);
                if(!is_null($shippingCost))
                {
                    $shippingCost = number_format((float)$shippingCost, 2, ',', '');
                }
                else
                {
                    $shippingCost = '';
                }

                $data = [
                    'id' 				=> $this->getSku($item),
                    'manufacturer' 		=> $this->elasticExportHelper->getExternalManufacturerName((int)$item['data']['item']['manufacturer']['id']),
                    'mpnr' 				=> $item['data']['variation']['model'],
                    'ean' 				=> $this->elasticExportHelper->getBarcodeByType($item, $settings->get('barcode')),
                    'name' 				=> $this->elasticExportHelper->getName($item, $settings) . (strlen($variationName) ? ' ' . $variationName : ''),
                    'description' 		=> $this->elasticExportHelper->getDescription($item, $settings),
                    'category_path' 	=> $this->elasticExportHelper->getCategory((int)$item['data']['defaultCategories'][0]['id'], $settings->get('lang'), $settings->get('plentyId')),
                    'price' 			=> number_format((float)$this->idlVariations[$item['id']]['variationRetailPrice.price'], 2, '.', ''),
                    'price_per_unit'	=> $this->elasticExportHelper->getBasePrice($item, $this->idlVariations),
                    'link' 				=> $this->elasticExportHelper->getUrl($item, $settings, true, false),
                    'image_url'			=> $this->elasticExportHelper->getMainImage($item, $settings),
                    'delivery_time' 	=> $this->elasticExportHelper->getAvailability($item, $settings, false),
                    'delivery_cost' 	=> $shippingCost,
                    'pzn' 				=> '',
                    'stock' 			=> $this->idlVariations[$item['id']]['variationStock.stockNet'],
                    'weight' 			=> $item['data']['variation']['weightG'],
                ];

                $this->addCSVContent(array_values($data));
            }
        }
    }

    /**
     * Get the SKU.
     * @param  array $item
     * @return string
     */
    private function getSku($item):string
    {
        return (string) $this->elasticExportHelper->generateSku($item['id'], self::CHECK24_DE, 0, (string)$item['data']['skus']['sku']);
    }

    /**
     * @param RecordList $idlResultList
     */
    private function createIdlArray($idlResultList)
    {
        if($idlResultList instanceof RecordList)
        {
            foreach($idlResultList as $idlVariation)
            {
                if($idlVariation instanceof Record)
                {
                    $this->idlVariations[$idlVariation->variationBase->id] = [
                        'itemBase.id' => $idlVariation->itemBase->id,
                        'variationBase.id' => $idlVariation->variationBase->id,
                        'variationStock.stockNet' => $idlVariation->variationStock->stockNet,
                        'variationRetailPrice.price' => $idlVariation->variationRetailPrice->price,
                        'variationRetailPrice.vatValue' => $idlVariation->variationRetailPrice->vatValue,
                    ];
                }
            }
        }
    }
}