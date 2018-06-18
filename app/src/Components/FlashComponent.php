<?php declare(strict_types = 1);

namespace App\Components;

use App\UI\BaseControl;

class FlashComponent extends BaseControl {

	/** @var array */
	private $flashes = [];

	public function setFlashes(array $flashes): void {
		$this->flashes = $flashes;
	}

	public function redrawFlashes() {
		$this->redrawControl('flashes');
	}

	public function render(array $flashes = []): void {
		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/flashes.latte');
		$template->flashes = $flashes ?: $this->flashes;

		$template->render();
	}

}
