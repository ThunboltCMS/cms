<?php declare(strict_types = 1);

namespace App\Routers;

use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use WebChemistry\Utils\Strings;

final class LocalRouter {

	/**
	 * @internal
	 * @param $url
	 * @return string
	 */
	public function webalize($url): string {
		return Strings::webalize((string) $url);
	}

	protected function addWebalizeStyle(string $name) {
		Route::$styles[$name] = Route::$styles['#'];

		Route::$styles[$name][Route::FILTER_IN] = [$this, 'webalize'];
		Route::$styles[$name][Route::FILTER_OUT] = [$this, 'webalize'];
	}

	public function createRouter(): RouteList {
		$this->addWebalizeStyle('name');

		$list = new RouteList();
		// Admin
		$admin = new RouteList('Admin');
		$admin[] = new Route('admin[/<presenter>[/<action>][/<id [0-9]+>[-<name [0-9a-zA-Z\-]+>]]]', [
			'presenter' => 'Homepage',
			'action' => 'default',
		]);

		$list[] = $admin;

		// Front
		$front = new RouteList('Front');
		$front[] = new Route('<presenter>[/<action>][/<id [0-9]+>[-<name [0-9a-zA-Z\-]+>]]', [
			'presenter' => 'Homepage',
			'action' => 'default',
		]);

		$list[] = $front;

		return $list;
	}

}
