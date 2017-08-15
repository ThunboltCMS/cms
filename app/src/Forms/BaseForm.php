<?php

declare(strict_types=1);

namespace App\Forms;

use App\Factories\Forms\IFormFactory;
use App\UI\Form;
use Doctrine\ORM\EntityManager;
use Thunbolt\Components\IFlashes;

abstract class BaseForm {

	/** @var IFormFactory */
	protected $factory;

	/** @var EntityManager */
	protected $em;

	/** @var IFlashes */
	private $flashes;

	public function injectComponents(EntityManager $em, IFormFactory $factory, IFlashes $flashes): void {
		$this->em = $em;
		$this->factory = $factory;
		$this->flashes = $flashes;
	}

	protected function create(): Form {
		return $this->factory->create();
	}

	protected function flashMessage(string $message, string $type = 'success'): \stdClass {
		return $this->flashes->flashMessage($message, $type);
	}

}
