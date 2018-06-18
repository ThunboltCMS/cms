<?php declare(strict_types = 1);

namespace App\Components;

interface IFlashFactory {

	public function create(): FlashComponent;

}
