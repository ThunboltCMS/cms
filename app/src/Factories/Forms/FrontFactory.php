<?php

namespace App\Factories\Forms;

use App\Renderers\ITemplateFormRenderer;
use Nette\Localization\ITranslator;
use WebChemistry\Forms\Factory\DefaultFormFactory;
use WebChemistry\Forms\Form;

class FrontFactory extends DefaultFormFactory {

	/** @var ITemplateFormRenderer */
	private $templateFormRenderer;

	public function __construct(ITemplateFormRenderer $templateFormRenderer, ITranslator $translator = NULL) {
		parent::__construct($translator);
		$this->templateFormRenderer = $templateFormRenderer;
	}

	/**
	 * @return Form
	 */
	public function create() {
		$form = parent::create();

		$form->setRenderer($this->templateFormRenderer->create(__DIR__ . '/templates/bootstrap.latte'));

		return $form;
	}

}
