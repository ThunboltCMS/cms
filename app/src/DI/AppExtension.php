<?php declare(strict_types = 1);

namespace App\DI;

use App\Latte\FilterLoader;
use App\Latte\LatteMacros;
use App\Latte\LatteParameters;
use Nette\DI\CompilerExtension;

final class AppExtension extends CompilerExtension {

	public function loadConfiguration(): void {
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('latteParameters'))
			->setFactory(LatteParameters::class);

		$builder->addDefinition($this->prefix('filterLoader'))
			->setFactory(FilterLoader::class);
	}

	public function beforeCompile(): void {
		$builder = $this->getContainerBuilder();


		$builder->getDefinition('latte.latteFactory')
			->getResultDefinition()
				->addSetup('?->addFilter(null, [?, ?])', ['@self', $this->prefix('@filterLoader'), 'load']);

		$builder->getDefinition('latte.latteFactory')
			->getResultDefinition()
				->addSetup('?->onCompile[] = function ($engine) { ' . LatteMacros::class . '::install($engine->getCompiler()); }', ['@self']);

		$builder->getDefinition('latte.templateFactory')
			->addSetup('?->onCreate[] = [?, "modify"]', ['@self', $builder->getDefinition($this->prefix('latteParameters'))]);
	}

}
