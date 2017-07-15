<?php

$configurator->addConfig(
	__DIR__ . '/config/environment/' . (getenv('NETTE_DEV') ? 'development.neon' : 'production.neon')
);

// only if we can't set env variable
/*$configurator->addConfig(__DIR__ . '/config/environment/development.neon');
//$configurator->addConfig(__DIR__ . '/config/environment/production.neon');*/
