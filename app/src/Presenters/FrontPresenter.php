<?php declare(strict_types = 1);

namespace App\Presenters;

use App\Forms\SignInForm;
use Nette\Application\UI\Form;
use WebChemistry\AssetsBuilder\IAssetsBuilder;
use WebChemistry\AssetsBuilder\Traits\TAssetsPreload;

abstract class FrontPresenter extends BasePresenter {

	use TAssetsPreload;

	/** @var SignInForm */
	private $signInForm;

	/** @var IAssetsBuilder */
	private $assetsBuilder;

	protected function beforeRender() {
		parent::beforeRender();

		$template = $this->getTemplate();

		$template->css = $this->assetsBuilder->buildCss();
		$template->js = $this->assetsBuilder->buildJs();
	}

	final public function injectFrontPresenter(SignInForm $signInForm, IAssetsBuilder $assetsBuilder) {
		$this->signInForm = $signInForm;
		$this->assetsBuilder = $assetsBuilder;
	}

	protected function createComponentSignInForm(): Form {
		$form = $this->signInForm->createSignIn();

		$form->onSuccess[] = function () {
			$this->redirect('Homepage:');
		};

		return $form;
	}

}
