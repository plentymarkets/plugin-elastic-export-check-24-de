<?php

namespace ElasticExportCheck24DE\Helper;

use ElasticExportCheck24DE\Generator\Check24Fashion;

class AttributeHelper
{
    const GOOGLE_ATTRIBUTE_LINK_KEY         = 'googleShoppingAttribute';
    const GOOGLE_ATTRIBUTE_TYPE_COLOR		= 'color';
    const GOOGLE_ATTRIBUTE_TYPE_SIZE		= 'size';
    const GOOGLE_ATTRIBUTE_TYPE_PATTERN	    = 'pattern';
    const GOOGLE_ATTRIBUTE_TYPE_MATERIAL	= 'material';

    const ATTRIBUTE_VALID_TYPES = [
        self::GOOGLE_ATTRIBUTE_TYPE_COLOR,
        self::GOOGLE_ATTRIBUTE_TYPE_SIZE,
        self::GOOGLE_ATTRIBUTE_TYPE_PATTERN,
        self::GOOGLE_ATTRIBUTE_TYPE_MATERIAL,
    ];

    const TRANS_KEYS_GOOGLE_TO_CHECK24 = [
        Check24Fashion::COLUMN_COLOR => self::GOOGLE_ATTRIBUTE_TYPE_COLOR,
        Check24Fashion::COLUMN_MANUFACTURER_COLOR => self::GOOGLE_ATTRIBUTE_TYPE_COLOR,
        Check24Fashion::COLUMN_PATTERN => self::GOOGLE_ATTRIBUTE_TYPE_PATTERN,
        Check24Fashion::COLUMN_SIZE => self::GOOGLE_ATTRIBUTE_TYPE_SIZE,
        Check24Fashion::COLUMN_MATERIAL => self::GOOGLE_ATTRIBUTE_TYPE_MATERIAL,
    ];

    /**
     * @var array
     */
    private $attributeLinkCache = [];

    /**
     * @param array $attributeValues
     */
    public function addToAttributeLinkCache(array $attributeValues)
    {
        foreach ($attributeValues as $attributeValueData) {
            if (isset($attributeValueData['attributeId'])) {
                $attributeId = $attributeValueData['attributeId'];

                if (!isset($this->attributeLinkCache[$attributeId]) &&
                    isset($attributeValueData['attribute'][self::GOOGLE_ATTRIBUTE_LINK_KEY]) &&
                    in_array($attributeValueData['attribute'][self::GOOGLE_ATTRIBUTE_LINK_KEY], self::ATTRIBUTE_VALID_TYPES))
                {
                    $this->attributeLinkCache[$attributeId] = $attributeValueData['attribute'][self::GOOGLE_ATTRIBUTE_LINK_KEY];
                }

                if (!isset($this->attributeLinkCache[$attributeId])) {
                    $this->attributeLinkCache[$attributeId] = '';
                }
            }
        }
    }

    /**
     * @param array $attributes
     * @param string $targetAttribute
     * @return int|null
     */
    public function getTargetAttributeValueId(array $attributes, string $targetAttribute)
    {
        foreach ($attributes as $attributeValue) {
            if (isset($attributeValue['attributeId']) &&
                $this->isTargetAttribute($attributeValue['attributeId'], $targetAttribute) &&
                isset($attributeValue['valueId']) && $attributeValue['valueId'] > 0)
            {
                return $attributeValue['valueId'];
            }
        }
        return null;
    }
    
    /**
     * @param array $attributes
     * @param string $targetAttribute
     * @return string
     */
    public function getTargetAttributeValue(array $attributes, string $targetAttribute):string
    {
        foreach ($attributes as $attributeValue) {
            if (isset($attributeValue['attributeId']) &&
                $this->isTargetAttribute($attributeValue['attributeId'], $targetAttribute) &&
                isset($attributeValue['value']['names']['name']) && strlen($attributeValue['value']['names']['name']))
            {
                return $attributeValue['value']['names']['name'];
            }
        }
        return '';
    }

    /**
     * @param int $attributeId
     * @param string $targetAttribute
     * @return bool
     */
    private function isTargetAttribute(int $attributeId, string $targetAttribute):bool
    {
        if (isset($this->attributeLinkCache[$attributeId])) {
            return  (bool)(self::TRANS_KEYS_GOOGLE_TO_CHECK24[$targetAttribute] == $this->attributeLinkCache[$attributeId]);
        }
        return false;
    }
}