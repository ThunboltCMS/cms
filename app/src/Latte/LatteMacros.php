<?php declare(strict_types = 1);

namespace App\Latte;

use Latte\Compiler;
use Latte\Macros\MacroSet;

class LatteMacros extends MacroSet {

	public static function install(Compiler $compiler): void {
		$me = new static($compiler);

	}

}
