<?php

namespace CarrooiTests\AddressableApp\Model\Facades;

use CarrooiTests\AddressableApp\Model\Entities\User;
use Kdyby\Doctrine\EntityManager;
use Nette\Object;

/**
 *
 * @author David Kudera
 */
class Users extends Object
{


	/** @var \Kdyby\Doctrine\EntityDao */
	private $dao;


	/**
	 * @param \Kdyby\Doctrine\EntityManager $em
	 */
	public function __construct(EntityManager $em)
	{
		$this->dao = $em->getRepository(User::getClassName());
	}


	/**
	 * @return \CarrooiTests\AddressableApp\Model\Entities\User
	 */
	public function create()
	{
		$user = new User;

		$this->dao->getEntityManager()->persist($user)->flush();

		return $user;
	}


	/**
	 * @param int $id
	 * @return \CarrooiTests\AddressableApp\Model\Entities\User
	 */
	public function findOneById($id)
	{
		return $this->dao->findOneBy([
			'id' => $id,
		]);
	}

}
