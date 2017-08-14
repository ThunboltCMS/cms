<?php

declare(strict_types=1);

namespace App\Forms;

use App\Factories\Forms\IFormFactory;
use App\UI\Form;
use Nette\Application\UI\Control;

abstract class BaseFormControl extends Control {

	/** @var IFormFactory */
	private $factory;

	public function injectComponents(IFormFactory $factory): void {
		$this->factory = $factory;
	}

	protected function createForm(): Form {
		return $this->factory->create();
	}

	abstract protected function templateFile(): string;

	abstract protected function createComponentForm(): Form;

	public function render(): void {
		$template = $this->getTemplate();
		$template->setFile($this->templateFile());

		$template->form = $this->getComponent('form');

		$template->render();
	}

}
