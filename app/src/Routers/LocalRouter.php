<?php

namespace App\Routers;

use Nette\Application\Routers\Route;
use WebChemistry\Routing\IRouter;
use WebChemistry\Routing\RouteManager;
use WebChemistry\Utils\Strings;

final class LocalRouter implements IRouter {

	public function createRouter(RouteManager $routeManager): void {
		$routeManager->addStyle('name');
		$routeManager->setStyleProperty('name', Route::FILTER_OUT, function($url) {
			return Strings::webalize($url);
		});
		$routeManager->setStyleProperty('name', Route::FILTER_IN, function($url) {
			return Strings::webalize($url);
		});

		// Front
		$front = $routeManager->getModule('Front');
		$front[] = new Route('<presenter>[/<action>][/<id [0-9]+>[-<name [0-9a-zA-Z\-]+>]]', [
			'presenter' => 'Homepage',
			'action' => 'default'
		]);
	}

}
