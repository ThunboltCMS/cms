<?php

declare(strict_types=1);

namespace App\Doctrine;

use Doctrine\ORM\EntityManager;
use Thunbolt\User\Interfaces\IUserDAO;
use Thunbolt\User\Interfaces\IUserModel;
use Thunbolt\User\Interfaces\IUserRepository;

class UserDAO implements IUserDAO {

	/** @var EntityManager */
	private $em;

	public function __construct(EntityManager $em) {
		$this->em = $em;
	}

	public function merge(IUserModel $model): void {
		$this->em->merge($model);
		$this->em->flush();
	}

	public function getRepository(): IUserRepository {
		throw new \Exception('TODO: return IUserRepository'); // Todo: return IUserRepository
	}

}
