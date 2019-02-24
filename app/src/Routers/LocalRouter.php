<?php declare(strict_types = 1);

namespace App\Routers;

use Contributte\Utils\Strings;
use Nette\Routing\Route;

final class LocalRouter {

	/**
	 * @internal
	 * @param $url
	 * @return string
	 */
	public function webalize($url): string {
		return Strings::webalize((string) $url);
	}

	public function createRouter(): RouteList {
		// Admin
		$admin = new RouteList('Admin');
		$admin->addRoute('admin[/<presenter>[/<action>][/<id [0-9]+>[-<name [0-9a-zA-Z\-]+>]]]', [
			'presenter' => 'Homepage',
			'action' => 'default',
		]);

		// Front
		$front = new RouteList('Front', [
			'name' => [
				Route::FILTER_IN => [$this, 'webalize'],
				Route::FILTER_OUT => [$this, 'webalize'],
			],
		]);
		$front->addRoute('<presenter>[/<action>][/<id [0-9]+>[-<name [0-9a-zA-Z\-]+>]]', [
			'presenter' => 'Homepage',
			'action' => 'default',
		]);


		// To list
		$list = new RouteList();
		$list[] = $admin;
		$list[] = $front;

		return $list;
	}

}
