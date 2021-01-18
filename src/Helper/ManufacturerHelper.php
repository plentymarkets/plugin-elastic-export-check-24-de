<?php

namespace ElasticExportCheck24DE\Helper;

use Plenty\Modules\Item\Manufacturer\Contracts\ManufacturerRepositoryContract;
use Plenty\Modules\Item\Manufacturer\Models\Manufacturer;

/**
 * Class ManufacturerHelper
 * @package ElasticExportCheck24DE\Helper
 */
class ManufacturerHelper
{
	const MAX_CACHE_SIZE = 200;

	/** @var ManufacturerRepositoryContract */
	private $manufacturerRepository;

	/** @var array */
	private $manufacturerCache;

	/**
	 * ManufacturerHelper constructor.
	 * @param ManufacturerRepositoryContract $manufacturerRepository
	 */
	public function __construct(ManufacturerRepositoryContract $manufacturerRepository)
	{
		$this->manufacturerRepository = $manufacturerRepository;
		$this->manufacturerCache = [];
	}

	/**
	 * Selects the manufacturer name by ID. Exports the name, if the external name is not configured.
	 *
	 * @param int $manufacturerId
	 * @return string
	 */
	public function getName(int $manufacturerId): string
	{
		if ($manufacturerId > 0 && !array_key_exists($manufacturerId, $this->manufacturerCache)) {
			try {
				/** @var Manufacturer $manufacturer */
				$manufacturer = $this->manufacturerRepository->findById($manufacturerId, ['externalName', 'name', 'id']);
			} catch (\Throwable $exception) {
				return '';
			}

			// limit the cache to 200 manufacturers
			if (count($this->manufacturerCache) > self::MAX_CACHE_SIZE) {
				array_shift($this->manufacturerCache);
			}

			if (strlen($manufacturer->externalName)) {
				$this->manufacturerCache[$manufacturerId] = $manufacturer->externalName;
			} elseif (strlen($manufacturer->name)) {
				$this->manufacturerCache[$manufacturerId] = $manufacturer->name;
			} else {
				$this->manufacturerCache[$manufacturerId] = '';
			}

			return $this->manufacturerCache[$manufacturerId];
		}

		return '';
	}
}