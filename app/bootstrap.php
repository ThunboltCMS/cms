<?php

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator();
$configurator->setDebugMode(false);

$bootstrap = new Thunbolt\Bootstrap(__DIR__, $configurator);
$bootstrap->initialize();

$configurator->addConfig(__DIR__ . '/config/extensions.neon');
$configurator->addConfig(__DIR__ . '/config/bundles.neon');
$configurator->addConfig(__DIR__ . '/config/services.neon');
$configurator->addConfig(__DIR__ . '/config/config.neon');

require __DIR__ . '/mode.php';

return $configurator->createContainer();
