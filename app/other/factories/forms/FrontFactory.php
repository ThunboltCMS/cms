<?php

namespace App\Factories\Forms;

use App\Renderers\Forms\FrontRenderer;
use Kdyby\Translation\Translator;
use Nette\Application\UI\ITemplateFactory;
use Nette\Localization\ITranslator;
use WebChemistry\Forms\Doctrine;
use WebChemistry\Forms\Factory\FormFactory;
use WebChemistry\Forms\Factory\IFormFactory;
use WebChemistry\Forms\Form;

class FrontFactory extends FormFactory implements IFormFactory {

	/** @var Translator */
	private $translator;


	public function __construct(ITemplateFactory $templateFactory = NULL, Doctrine $doctrine = NULL, ITranslator $translator = NULL) {
		parent::__construct($templateFactory, $doctrine);
		$this->translator = $translator;
	}

	/**
	 * @return Form
	 */
	public function create() {
		$form = parent::create();

		$form->setTranslator($this->translator);
		$form->setRenderer(new FrontRenderer());

		return $form;
	}

}
