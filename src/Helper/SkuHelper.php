<?php

namespace ElasticExportCheck24DE\Helper;

use Plenty\Modules\Item\VariationSku\Models\VariationSku;
use Plenty\Modules\Item\VariationSku\Contracts\VariationSkuRepositoryContract;
use ElasticExportCheck24DE\Generator\Check24Fashion;
use Plenty\Plugin\Log\Loggable;

class SkuHelper
{
    use Loggable;
    
    /**
     * @var VariationSkuRepositoryContract
     */
    private $variationSkuRepository;
    
    public function __construct()
    {
        $this->variationSkuRepository = pluginApp(VariationSkuRepositoryContract::class);
    }

    /**
     * @param array $variation
     * @param float $marketId
     * @param int $accountId
     */
    public function setSku(array &$variation, float $marketId, int $accountId)
    {
        try {
            if (isset($variation['id']) && isset($variation['data']['item']['id'])) {
                if(!isset($variation['data']['skus'][0]) || !isset($variation['data']['skus'][0]['sku'])) {
                    $skuData = [
                        'variationId' => $variation['id'],
                        'marketId' => $marketId,
                        'accountId' => $accountId,
                        'initialSku' => $variation['id'],
                        'sku' => $variation['id'],
                        'parentSku' => $variation['data']['item']['id'],
                        'createdAt' => date("Y-m-d H:i:s"),
                    ];
                    $skuData = $this->variationSkuRepository->create($skuData);
                } elseif (!strlen($variation['data']['skus'][0]['sku']) ||
                    !isset($variation['data']['skus'][0]['parentSku']) ||
                    !strlen($variation['data']['skus'][0]['parentSku']))
                {
                    $skuDataList = $this->variationSkuRepository->search([
                        'variationId' => $variation['id'],
                        'marketId' => $marketId,
                        'accountId' => $accountId
                    ]);

                    if (count($skuDataList)) {
                        $changed = false;
                        foreach ($skuDataList as $skuData) {
                            if (strlen($skuData->sku) == 0 && (int)$variation['id'] > 0) {
                                $skuData->sku = $variation['id'];
                                $changed = true;
                            }
                            if (strlen($skuData->parentSku) == 0 && (int)$variation['data']['item']['id'] > 0) {
                                $skuData->parentSku = $variation['data']['item']['id'];
                                $changed = true;
                            }
                            if ($changed) {
                                $skuData = $this->variationSkuRepository->update($skuData->toArray(), $skuData->id);
                            }
                        }
                    }
                }
            }
        } catch (\Exception $exception) {
            $this->getLogger(__METHOD__)->logException($exception);
        }

        if (isset($skuData) && $skuData instanceof VariationSku) {
            $variation['data']['skus'][0]['sku'] = $skuData->sku;
            $variation['data']['skus'][0]['parentSku'] = $skuData->parentSku;
        } else {
            if (!isset($variation['data']['skus'][0]['parentSku']) || !strlen($variation['data']['skus'][0]['parentSku'])) {
                if (isset($variation['data']['item']['id']) && strlen($variation['data']['item']['id'])) {
                    $variation['data']['skus'][0]['parentSku'] = $variation['data']['item']['id'];
                } else {
                    $variation['data']['skus'][0]['parentSku'] = '';
                }
            }

            if (!isset($variation['data']['skus'][0]['sku']) || !strlen($variation['data']['skus'][0]['sku'])) {
                if (isset($variation['id']) && strlen($variation['id'])) {
                    $variation['data']['skus'][0]['sku'] = $variation['id'];
                } else {
                    $variation['data']['skus'][0]['sku'] = '';
                }
            }
        }
    }
}