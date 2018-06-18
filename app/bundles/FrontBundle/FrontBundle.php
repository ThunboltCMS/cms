<?php declare(strict_types = 1);

namespace FrontBundle;

use Thunbolt\Bundles\Bundle;

final class FrontBundle extends Bundle {

	public function getBaseFolder(): string {
		return __DIR__;
	}

}
