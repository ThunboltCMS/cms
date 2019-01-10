<?php declare(strict_types = 1);

namespace App\DI;

use App\Latte\FilterLoader;
use App\Latte\LatteMacros;
use App\Latte\LatteParameters;
use Nette\DI\CompilerExtension;
use WebChemistry\Utils\DI\DIHelpers;

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

		$helper = new DIHelpers($builder);
		$helper->registerLatteFilterLoader($this->prefix('@filterLoader'));
		$helper->registerLatteMacroLoader(LatteMacros::class);

		$builder->getDefinition('latte.templateFactory')
			->addSetup('?->onCreate[] = [?, "modify"]', ['@self', $builder->getDefinition($this->prefix('latteParameters'))]);
	}

}
