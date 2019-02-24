<?php declare(strict_types = 1);

namespace App\Routers;

use Nette\Application\Routers\RouteList as NetteRouteList;

class RouteList extends NetteRouteList {

	/** @var array */
	private $defaultMetadata;

	public function __construct(?string $module = null, array $defaultMetadata = []) {
		parent::__construct($module);

		$this->defaultMetadata = $defaultMetadata;
	}

	public function addRoute(string $mask, $metadata = [], int $flags = 0) {
		if ($this->defaultMetadata) {
			$metadata = array_merge_recursive($this->defaultMetadata, $metadata);
		}

		return parent::addRoute($mask, $metadata, $flags);
	}

}
