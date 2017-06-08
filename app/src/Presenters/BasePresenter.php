<?php

declare(strict_types=1);

namespace App\Presenters;

use Doctrine\ORM\EntityManager;
use Thunbolt\Application\Presenter;

abstract class BasePresenter extends Presenter {

	/** @var EntityManager @inject */
	public $em;

}
