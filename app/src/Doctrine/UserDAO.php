<?php declare(strict_types = 1);

namespace App\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Thunbolt\User\Interfaces\IUserDAO;
use Thunbolt\User\Interfaces\IUserEntity;
use Thunbolt\User\Interfaces\IUserRepository;

class UserDAO implements IUserDAO {

	/** @var EntityManagerInterface */
	private $em;

	public function __construct(EntityManagerInterface $em) {
		$this->em = $em;
	}

	public function merge(IUserEntity $entity): void {
		$this->em->merge($entity);
		$this->em->flush();
	}

	public function getRepository(): IUserRepository {
		throw new \Exception('TODO: return IUserRepository'); // Todo: return IUserRepository
	}

}
