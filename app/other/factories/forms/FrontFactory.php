<?php

namespace App\Factories\Forms;

use App\Renderers\Forms\FrontRenderer;
use Kdyby\Translation\Translator;
use Nette\Application\UI\ITemplateFactory;
use Nette\Object;
use WebChemistry\Forms\Doctrine;
use WebChemistry\Forms\Factory\IFormFactory;
use WebChemistry\Forms\Form;

class FrontFactory extends Object implements IFormFactory {

	/** @var Doctrine */
	private $doctrine;

	/** @var array */
	private $parameters;

	/** @var Translator */
	private $translator;

	/** @var ITemplateFactory */
	private $templateFactory;

	/**
	 * @param Doctrine $doctrine
	 * @param Translator $translator
	 */
	public function __construct(Doctrine $doctrine, Translator $translator = NULL, ITemplateFactory $templateFactory = NULL) {
		$this->doctrine = $doctrine;
		$this->translator = $translator;
		$this->templateFactory = $templateFactory;
	}

	/**
	 * @param array $parameters
	 * @return self
	 */
	public function setParameters(array $parameters) {
		$this->parameters = $parameters;

		return $this;
	}

	/**
	 * @return Form
	 */
	public function create() {
		$form = new Form;

		$form->setRenderer(new FrontRenderer());
		if ($this->translator) {
			$form->setTranslator($this->translator);
		}
		if (isset($this->parameters['recaptcha'])) {
			$form->setRecaptchaConfig($this->parameters['recaptcha']);
		}
		$form->injectComponents($this->doctrine, $this->templateFactory);

		return $form;
	}

}
