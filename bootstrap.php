<?php

use DI\ContainerBuilder;

require_once __DIR__ . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(
    __DIR__ . '/configs/config.php'
);