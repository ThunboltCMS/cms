<?php

$configurator->addConfig(
	__DIR__ . '/config/environment/' . (getenv('NETTE_DEV') ? 'development.neon' : 'production.neon')
);

