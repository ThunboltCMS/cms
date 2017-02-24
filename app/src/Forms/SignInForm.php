<?php

namespace App\Forms;

use Nette\Utils\ArrayHash;
use Thunbolt\Forms\BaseForm;
use Thunbolt\Forms\FormArgs;
use Thunbolt\Localization\TranslatorProvider;
use Thunbolt\User\BadPasswordException;
use Thunbolt\User\Interfaces\ISignInForm;
use Thunbolt\User\UserNotFoundException;
use WebChemistry\Forms\Form;
use Thunbolt\User\User;

class SignInForm extends BaseForm implements ISignInForm {

	/** @var User */
	private $user;

	public function __construct(FormArgs $formArgs, User $user) {
		parent::__construct($formArgs);

		$this->user = $user;
	}

	/**
	 * @return Form
	 */
	public function createSignIn() {
		$form = $this->createForm();

		$form->addText('email', 'core.user.email')
			->setRequired()
			->addRule($form::EMAIL);

		$form->addPassword('password', 'core.user.password')
			->setRequired();

		$form->addCheckbox('remember', 'core.user.remember');

		$form->addSubmit('send', 'core.user.signIn');
		$form->onSuccess[] = [$this, 'successSignIn'];

		return $form;
	}

	/**
	 * @param Form $form
	 * @param ArrayHash $values
	 */
	public function successSignIn(Form $form, $values) {
		if ($values->remember) {
			$this->user->setExpiration('14 days', FALSE);
		} else {
			$this->user->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->user->login($values->email, $values->password);
		} catch (BadPasswordException $e) {
			$form->addError($form->getTranslator()->translate($e->getMessage()));
		} catch (UserNotFoundException $e) {
			$form->addError($form->getTranslator()->translate($e->getMessage()));
		}
	}

}
