<?php

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Thunbolt\Configuration\Configuration();
$bootstrap = new Thunbolt\Bootstrap(__DIR__);

$bootstrap->initialize();
//$configurator->setDebugMode(FALSE);

$configurator->enableDebugger(__DIR__ . '/../log');
$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
	->addDirectory(__DIR__ . '/other')
	->addDirectory(__DIR__ . '/modules')
	->register();

$configurator->setScanDirs([__DIR__ . '/modules']);

$bootstrap->loadComposerConfig($configurator);

$configurator->addConfig(__DIR__ . '/config/settings.neon');
require __DIR__ . '/mode.php';
$configurator->addAutoloadConfig(__DIR__ . '/modules/', 'config.neon', 1);
$configurator->addConfig(__DIR__ . '/config/config.local.neon');

return $configurator->createContainer();
