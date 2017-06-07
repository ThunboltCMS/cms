<?php

// Uncomment this line if you must temporarily take down your site for maintenance.
// require __DIR__ . '/.maintenance.php';

use Nette\Application\Application;

$container = require __DIR__ . '/../app/bootstrap.php';

$container->getByType(Application::class)->run();
