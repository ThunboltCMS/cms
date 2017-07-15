<?php

declare(strict_types=1);

namespace App\Latte;

use Nette\SmartObject;

final class FilterLoader {

	use SmartObject;

	public function loader(string $name, ...$args) {
		if (method_exists($this, $name) && $name !== 'loader') {
			return call_user_func_array([$this, $name], $args);
		}
	}

}
