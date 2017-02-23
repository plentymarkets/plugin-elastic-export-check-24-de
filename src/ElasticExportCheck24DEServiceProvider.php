<?php

namespace ElasticExportCheck24DE;

use Plenty\Modules\DataExchange\Services\ExportPresetContainer;
use Plenty\Plugin\DataExchangeServiceProvider;

class ElasticExportCheck24DEServiceProvider extends DataExchangeServiceProvider
{
    public function register()
    {

    }

    public function exports(ExportPresetContainer $container)
    {
        $container->add(
            'Check24DE-Plugin',
            'ElasticExportCheck24DE\ResultField\Check24DE',
            'ElasticExportCheck24DE\Generator\Check24DE',
            true
        );
    }
}