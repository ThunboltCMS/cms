<?php declare(strict_types = 1);

namespace App\Presenters;

use Nette\Application\IPresenter;
use Tracy\ILogger;
use Nette;
use Nette\Application\Responses;

final class ErrorPresenter implements IPresenter {

	/** @var ILogger */
	private $logger;

	public function __construct(ILogger $logger) {
		$this->logger = $logger;
	}

	/**
	 * @return Nette\Application\IResponse
	 */
	public function run(Nette\Application\Request $request): Nette\Application\IResponse {
		$e = $request->getParameter('exception');
		if ($e instanceof Nette\Application\BadRequestException) {
			// $this->logger->log("HTTP code {$e->getCode()}: {$e->getMessage()} in {$e->getFile()}:{$e->getLine()}", 'access');
			list($module, , $sep) = Nette\Application\Helpers::splitName($request->getPresenterName());

			return new Responses\ForwardResponse($request->setPresenterName($module . $sep . 'Error4xx'));
		}
		$this->logger->log($e, ILogger::EXCEPTION);

		return new Responses\CallbackResponse(function () {
			require __DIR__ . '/templates/Error/500.phtml';
		});
	}

}