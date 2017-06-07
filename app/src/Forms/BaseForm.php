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

	/**
	 * @param EntityManager $em
	 */
	public function setEntityManager(EntityManager $em) {
		$this->em = $em;
	}

	/**
	 * @param IFormFactory $factory
	 */
	public function setFactory(IFormFactory $factory) {
		$this->factory = $factory;
	}

	protected function create(): Form {
		return $this->factory->create();
	}

}
