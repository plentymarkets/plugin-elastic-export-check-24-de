<?php

namespace ElasticExportCheck24DE\ResultField;

use Plenty\Modules\Cloud\ElasticSearch\Lib\ElasticSearch;
use Plenty\Modules\DataExchange\Contracts\ResultFields;
use Plenty\Modules\DataExchange\Models\FormatSetting;
use Plenty\Modules\Helper\Services\ArrayHelper;
use Plenty\Modules\Item\Search\Mutators\BarcodeMutator;
use Plenty\Modules\Item\Search\Mutators\ImageMutator;
use Plenty\Modules\Cloud\ElasticSearch\Lib\Source\Mutator\BuiltIn\LanguageMutator;
use Plenty\Modules\Item\Search\Mutators\KeyMutator;
use Plenty\Modules\Item\Search\Mutators\SkuMutator;
use Plenty\Modules\Item\Search\Mutators\DefaultCategoryMutator;

/**
 * Class Check24DE
 * @package ElasticExport\ResultFields
 */
class Check24DE extends ResultFields
{
    const CHECK24_DE = 150.00;

    /**
     * @var ArrayHelper
     */
    private $arrayHelper;

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
     * Generate result fields.
     *
     * @param  array $formatSettings = []
     * @return array
     */
    public function generateResultFields(array $formatSettings = []):array
    {
        $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');

        $this->setOrderByList(['item.id', ElasticSearch::SORTING_ORDER_ASC]);

        $reference = $settings->get('referrerId') ? $settings->get('referrerId') : self::CHECK24_DE;

        $itemDescriptionFields = ['texts.urlPath', 'texts.lang'];

        $itemDescriptionFields[] = ($settings->get('nameId')) ? 'texts.name' . $settings->get('nameId') : 'texts.name1';

        if($settings->get('descriptionType') == 'itemShortDescription'
            || $settings->get('previewTextType') == 'itemShortDescription')
        {
            $itemDescriptionFields[] = 'texts.shortDescription';
        }

        if($settings->get('descriptionType') == 'itemDescription'
            || $settings->get('descriptionType') == 'itemDescriptionAndTechnicalData'
            || $settings->get('previewTextType') == 'itemDescription'
            || $settings->get('previewTextType') == 'itemDescriptionAndTechnicalData')
        {
            $itemDescriptionFields[] = 'texts.description';
        }
        $itemDescriptionFields[] = 'texts.technicalData';

        //Mutator
        /**
         * @var ImageMutator $imageMutator
         */
        $imageMutator = pluginApp(ImageMutator::class);
        if($imageMutator instanceof ImageMutator)
        {
            $imageMutator->addMarket($reference);
        }

        /**
         * @var KeyMutator $keyMutator
         */
        $keyMutator = pluginApp(KeyMutator::class);
        if($keyMutator instanceof KeyMutator)
        {
            $keyMutator->setKeyList($this->getKeyList());
            $keyMutator->setNestedKeyList($this->getNestedKeyList());
        }

        /**
         * @var LanguageMutator $languageMutator
         */
        $languageMutator = pluginApp(LanguageMutator::class, [[$settings->get('lang')]]);

        /**
         * @var SkuMutator $skuMutator
         */
        $skuMutator = pluginApp(SkuMutator::class);
        if($skuMutator instanceof SkuMutator)
        {
            $skuMutator->setMarket($reference);
        }

        /**
         * @var DefaultCategoryMutator $defaultCategoryMutator
         */
        $defaultCategoryMutator = pluginApp(DefaultCategoryMutator::class);
        if($defaultCategoryMutator instanceof DefaultCategoryMutator)
        {
            $defaultCategoryMutator->setPlentyId($settings->get('plentyId'));
        }

        /**
         * @var BarcodeMutator $barcodeMutator
         */
        $barcodeMutator = pluginApp(BarcodeMutator::class);
        if($barcodeMutator instanceof BarcodeMutator)
        {
            $barcodeMutator->addMarket($reference);
        }

        $fields = [
            [
                //item
                'item.id',
                'item.manufacturer.id',

                //variation
                'id',
                'variation.availability.id',
                'variation.stockLimitation',
                'variation.vatId',
                'variation.model',
                'variation.isMain',
                'variation.weightG',

                //images
                'images.all.urlMiddle',
                'images.all.urlPreview',
                'images.all.urlSecondPreview',
                'images.all.url',
                'images.all.path',
                'images.all.position',

                'images.item.urlMiddle',
                'images.item.urlPreview',
                'images.item.urlSecondPreview',
                'images.item.url',
                'images.item.path',
                'images.item.position',

                'images.variation.urlMiddle',
                'images.variation.urlPreview',
                'images.variation.urlSecondPreview',
                'images.variation.url',
                'images.variation.path',
                'images.variation.position',

                //unit
                'unit.content',
                'unit.id',

                //sku
                'skus.sku',

                //defaultCategories
                'defaultCategories.id',

                //barcodes
                'barcodes.code',
                'barcodes.type',

                //attributes
                'attributes.attributeValueSetId',
                'attributes.attributeId',
                'attributes.valueId',

            ],

            [
                $keyMutator,
                $languageMutator,
                $skuMutator,
                $defaultCategoryMutator,
                $barcodeMutator,
            ],
        ];

        if($reference != -1)
        {
            $fields[1][] = $imageMutator;
        }

        foreach($itemDescriptionFields as $itemDescriptionField)
        {
            $fields[0][] = $itemDescriptionField;
        }

        return $fields;
    }

    /**
     * Returns the list of keys.
     *
     * @return array
     */
    private function getKeyList()
    {
        $keyList = [
            //item
            'item.id',
            'item.manufacturer.id',

            //variation
            'variation.availability.id',
            'variation.stockLimitation',
            'variation.vatId',
            'variation.model',
            'variation.isMain',
            'variation.weightG',

            //unit
            'unit.content',
            'unit.id',
        ];

        return $keyList;
    }

    /**
     * Returns the list of nested keys.
     *
     * @return mixed
     */
    private function getNestedKeyList()
    {
        $nestedKeyList['keys'] = [
            //images
            'images.all',
            'images.item',
            'images.variation',

            //sku
            'skus',

            //texts
            'texts',

            //defaultCategories
            'defaultCategories',

            //barcodes
            'barcodes',

            //attributes
            'attributes',
        ];

        $nestedKeyList['nestedKeys'] = [
            //images
            'images.all' => [
                'urlMiddle',
                'urlPreview',
                'urlSecondPreview',
                'url',
                'path',
                'position',
            ],
            'images.item' => [
                'urlMiddle',
                'urlPreview',
                'urlSecondPreview',
                'url',
                'path',
                'position',
            ],
            'images.variation' => [
                'urlMiddle',
                'urlPreview',
                'urlSecondPreview',
                'url',
                'path',
                'position',
            ],

            //sku
            'skus' => [
                'sku',
            ],

            //texts
            'texts' => [
                'urlPath',
                'lang',
                'name1',
                'name2',
                'name3',
                'shortDescription',
                'description',
                'technicalData',
            ],

            //defaultCategories
            'defaultCategories' => [
                'id',
            ],

            //barcodes
            'barcodes' => [
                'code',
                'type',
            ],

            //attributes
            'attributes' => [
                'attributeValueSetId',
                'attributeId',
                'valueId',
            ],
        ];

        return $nestedKeyList;
    }
}