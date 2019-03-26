<?php

use App\Booting;
use Nette\Application\Application;

require __DIR__ . '/../vendor/autoload.php';

$booting = new Booting(__DIR__ . '/.maintenance.php', true);

//$booting->setMaintenance(true);

$booting->boot()
	->createContainer()
	->getByType(Application::class)
	->run();
