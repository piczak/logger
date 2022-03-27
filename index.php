<?php

require_once  __DIR__ . '/vendor/autoload.php';

use DI\ContainerBuilder;
use Recman\MessageProcessor;

$file = $argv[1];
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__.'/configs/config.php');

$container = $containerBuilder->build();
$processor = $container->get(MessageProcessor::class);
$processor->process(file_get_contents($file));
