<?php

declare(strict_types=1);

namespace App\Latte;

use Nette\Application\UI\ITemplate;

final class LatteParameters {

	public function modify(ITemplate $template): void {
		// latte parameters: $template->...
	}

}
