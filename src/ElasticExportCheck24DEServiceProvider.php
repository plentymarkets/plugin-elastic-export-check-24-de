<?php

namespace ElasticExportCheck24DE;

use Plenty\Modules\DataExchange\Services\ExportPresetContainer;
use Plenty\Plugin\DataExchangeServiceProvider;

/**
 * Class ElasticExportCheck24DEServiceProvider
 * @package ElasticExportCheck24DE
 */
class ElasticExportCheck24DEServiceProvider extends DataExchangeServiceProvider
{
    /**
     * Abstract function definition for registering the service provider.
     */
    public function register()
    {

    }

    /**
     * Adds the export format to the export container.
     *
     * @param ExportPresetContainer $container
     */
    public function exports(ExportPresetContainer $container)
    {
        $container->add(
            'Check24DE-Plugin',
            'ElasticExportCheck24DE\ResultField\Check24DE',
            'ElasticExportCheck24DE\Generator\Check24DE',
            '',
            true,
            true
        );

        $container->add(
            'Check24DE Fashion',
            'ElasticExportCheck24DE\ResultField\Check24Fashion',
            'ElasticExportCheck24DE\Generator\Check24Fashion',
            '',
            true,
            true
        );
    }
}