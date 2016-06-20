<?php

namespace App\Presenters\FrontModule;

use Thunbolt\Errors\ErrorTemplate;

class ErrorPresenter extends FrontPresenter {

	/**
	 * @param \Exception $exception
	 * @throws \Nette\Application\AbortException
	 */
	public function renderDefault(\Exception $exception) {
		ErrorTemplate::handleErrorPage($exception);

		$this->terminate();
	}

}
