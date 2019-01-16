<?php declare(strict_types = 1);

namespace App\Forms;

use Nette\Application\UI\Form;
use Thunbolt\User\BadPasswordException;
use Thunbolt\User\Interfaces\ISignInForm;
use Thunbolt\User\UserNotFoundException;
use Thunbolt\User\User;

final class SignInForm extends BaseForm implements ISignInForm {

	/** @var User */
	private $user;

	public function __construct(User $user) {
		$this->user = $user;
	}

	public function createSignIn(): Form {
		$form = $this->create();

		$form->addText('name', 'Email')
			->setRequired()
			->addRule($form::EMAIL);

		$form->addPassword('password', 'Heslo')
			->setRequired();

		$form->addCheckbox('remember', 'Zapamatovat');

		$form->addSubmit('send', 'Přihlásit');
		$form->onSuccess[] = [$this, 'successSignIn'];

		return $form;
	}

	public function successSignIn(Form $form, array $values): void {
		if ($values['remember']) {
			$this->user->setExpiration('14 days');
		} else {
			$this->user->setExpiration('20 minutes');
		}

		try {
			$this->user->login($values['name'], $values['password']);
		} catch (BadPasswordException $e) {
			$form->addError('Špatně zadané heslo.');
		} catch (UserNotFoundException $e) {
			$form->addError('Špatně zadané heslo.');
		}
	}

}
