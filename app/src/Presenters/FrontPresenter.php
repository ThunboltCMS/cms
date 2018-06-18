<?php declare(strict_types = 1);

namespace App\Presenters;

use App\Forms\SignInForm;
use App\UI\Form;

abstract class FrontPresenter extends BasePresenter {

	/** @var SignInForm */
	private $signInForm;

	public function injectSignInForms(SignInForm $signInForm) {
		$this->signInForm = $signInForm;
	}

	protected function createComponentSignInForm(): Form {
		$form = $this->signInForm->createSignIn();

		$form->onSuccess[] = function () {
			$this->redirect('Homepage:');
		};

		return $form;
	}

}
