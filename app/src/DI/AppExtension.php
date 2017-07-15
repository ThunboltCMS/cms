<?php

declare(strict_types=1);

namespace App\DI;

use App\Latte\FilterLoader;
use Nette\DI\CompilerExtension;

final class AppExtension extends CompilerExtension {

	public function loadConfiguration(): void {
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('filterLoader'))
			->setClass(FilterLoader::class);
	}

	public function beforeCompile(): void {
		$builder = $this->getContainerBuilder();

		$builder->getDefinition('latte.latteFactory')
			->addSetup('?->addFilter(null, [?, "loader"]);', [
				'@self',
				$this->prefix('@filterLoader'),
			]);
	}

}
