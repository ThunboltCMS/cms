<?php

declare(strict_types=1);

namespace App\Forms;

use App\Factories\Forms\IFormFactory;
use App\UI\Form;
use Doctrine\ORM\EntityManager;

abstract class BaseForm {

	/** @var IFormFactory */
	protected $factory;

	/** @var EntityManager */
	protected $em;

	public function injectComponents(EntityManager $em, IFormFactory $factory): void {
		$this->em = $em;
		$this->factory = $factory;
	}

	protected function create(): Form {
		return $this->factory->create();
	}

}
