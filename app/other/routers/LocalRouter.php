<?php

namespace App\Routers;

use Nette\Application\Routers\Route;
use WebChemistry\Routing\IRouter;
use WebChemistry\Routing\RouteManager;
use Thunbolt\Routing\Router;

class LocalRouter extends Router implements IRouter {

	/**
	 * @param RouteManager $routeManager
	 * @return void
	 */
	public function createRouter(RouteManager $routeManager) {
		parent::createRouter($routeManager);
	}

}
