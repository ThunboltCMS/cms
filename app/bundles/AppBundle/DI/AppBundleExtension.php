<?php

namespace AppBundle\DI;

use Thunbolt\Bundles\BundleExtension;

class AppBundleExtension extends BundleExtension {

	public function getBaseFolder() {
		return __DIR__ . '/..';
	}

}
