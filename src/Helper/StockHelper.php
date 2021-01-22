<?php

namespace ElasticExportCheck24DE\Helper;

use Illuminate\Support\Collection;
use Plenty\Modules\Item\Variation\Contracts\VariationExportServiceContract;
use Plenty\Modules\Item\Variation\Services\ExportPreloadValue\ExportPreloadValue;
use Plenty\Modules\StockManagement\Stock\Contracts\StockRepositoryContract;
use Plenty\Modules\StockManagement\Stock\Models\Stock;
use Plenty\Repositories\Models\PaginatedResult;
use Plenty\Modules\Helper\Models\KeyValue;

class StockHelper
{
	const NO_STOCK_LIMITATION = 0;
	const USE_NET_STOCK = 1;
	const NO_STOCK_INVENTORY = 2;

	/** @var int */
	private $stockBuffer;

	/** @var int */
	private $stockForVariationsWithoutStockLimitation = null;

	/** @var int */
	private $stockForVariationsWithoutStockAdministration = null;

	/**
	 * StockHelper constructor.
	 * @param KeyValue $settings
	 */
    public function __construct(KeyValue $settings)
    {
    	$this->setAdditionalStockInformation($settings);
    }

    /**
     * Returns the calculated stock by preloaded stock data of the VariationExportService.
     *
     * @param array $variation
     * @param array $preloadedStockData
     * @return int
     */
    public function calculateStock(array $variation, array $preloadedStockData):int
    {
        $stockNet = (int)$preloadedStockData[0]['stockNet'];

        // stock limitation do not stock inventory
        if ($variation['data']['variation']['stockLimitation'] == self::NO_STOCK_INVENTORY) {
            if (is_numeric($this->stockForVariationsWithoutStockAdministration)) {
                $stockNet = $this->stockForVariationsWithoutStockAdministration;
            } else {
                $stockNet = 999;
            }
        }

        // stock limitation use net stock
        elseif ($variation['data']['variation']['stockLimitation'] == self::USE_NET_STOCK) {
			$stockNet = $stockNet - $this->stockBuffer;

			if ($stockNet > 999) {
				$stockNet = 999;
			}
        }

        // no limitation
        elseif ($variation['data']['variation']['stockLimitation'] == self::NO_STOCK_LIMITATION) {
			if (is_numeric($this->stockForVariationsWithoutStockLimitation)) {
				$stockNet = $this->stockForVariationsWithoutStockLimitation;
			} else {
				$stockNet = 999;
			}
        }

		if ($stockNet < 0) {
			$stockNet = 0;
		}

        return (int)$stockNet;
    }

	/**
	 * @param KeyValue $settings
	 */
	private function setAdditionalStockInformation(KeyValue $settings)
	{
		$this->stockBuffer = $settings->get('stockBuffer', 0);

		if($settings->get('stockForVariationsWithoutStockAdministration', 0) > 0) {
			$this->stockForVariationsWithoutStockAdministration = $settings->get('stockForVariationsWithoutStockAdministration');
		}

		if($settings->get('stockForVariationsWithoutStockLimitation', 0) > 0) {
			$this->stockForVariationsWithoutStockLimitation = $settings->get('stockForVariationsWithoutStockLimitation');
		}
	}
}