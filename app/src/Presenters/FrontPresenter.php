<?php declare(strict_types = 1);

namespace App\Presenters;

use App\Forms\SignInForm;
use Nette\Application\UI\Form;
use Thunbolt\Assets\IAssetsLoader;

abstract class FrontPresenter extends BasePresenter {

	/** @var SignInForm */
	private $signInForm;

	/** @var IAssetsLoader */
	private $assetsLoader;

	protected function startup() {
		parent::startup();

		if (!$this->isAjax()) {
			$this->assetsLoader->preload();
		}
	}

	protected function beforeRender() {
		parent::beforeRender();

		$template = $this->getTemplate();
		$template->_assets = [
			'styles' => $this->assetsLoader->getHtmlStyles(),
			'javascript' => $this->assetsLoader->getHtmlJavascript(),
		];
	}

	public function injectSignInForms(SignInForm $signInForm): void {
		$this->signInForm = $signInForm;
	}

	public function injectAssetsLoader(IAssetsLoader $assetsLoader): void {
		$this->assetsLoader = $assetsLoader;
	}

	protected function createComponentSignInForm(): Form {
		$form = $this->signInForm->createSignIn();

		$form->onSuccess[] = function () {
			$this->redirect('Homepage:');
		};

		return $form;
	}

}
