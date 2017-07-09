<?php

declare(strict_types=1);

namespace AppBundle;

use Thunbolt\Bundles\Bundle;

final class AppBundle extends Bundle {

	public function getBaseFolder(): string {
		return __DIR__;
	}

}
