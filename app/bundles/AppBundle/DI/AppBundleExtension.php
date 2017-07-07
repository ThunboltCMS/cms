<?php

declare(strict_types=1);

namespace AppBundle\DI;

use Thunbolt\Bundles\BundleExtension;

final class AppBundleExtension extends BundleExtension {

	public function getBaseFolder(): string {
		return __DIR__ . '/..';
	}

}
