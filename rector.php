<?php

use App\CustomInterface;
use App\CustomProcessor;
use Rector\Config\RectorConfig;

use function RectorPrefix202308\Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;

return static function (RectorConfig $rectorConfig): void {
    $services = $rectorConfig->services();
    $services->defaults()
        ->public()
        ->autowire()
        ->autoconfigure();

    $services->instanceof(CustomInterface::class)->tag(CustomInterface::class);
    $services->load('App\\', __DIR__ . '/src');

    $rectorConfig->paths([
        __DIR__ . '/src',
    ]);
    $rectorConfig->sets([\Rector\Set\ValueObject\SetList::DEAD_CODE]);

    // Lines below not configured before rector 0.17.1
    $services->set(CustomProcessor::class)->arg('$rectors', tagged_iterator(CustomInterface::class));
};
