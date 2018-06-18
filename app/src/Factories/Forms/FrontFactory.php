<?php declare(strict_types = 1);

namespace App\Factories\Forms;

use Thunbolt\ITemplateFormRenderer;
use App\UI\Form;
use Nette\Localization\ITranslator;

final class FrontFactory implements IFormFactory {

	/** @var ITemplateFormRenderer */
	private $templateFormRenderer;

	/** @var ITranslator */
	private $translator;

	public function __construct(ITemplateFormRenderer $templateFormRenderer, ?ITranslator $translator = null) {
		$this->templateFormRenderer = $templateFormRenderer;
		$this->translator = $translator;
	}

	public function create(): Form {
		$form = new Form();

		$form->setTranslator($this->translator);
		$form->setRenderer($this->templateFormRenderer->create(__DIR__ . '/templates/bootstrap.latte'));

		return $form;
	}

}
