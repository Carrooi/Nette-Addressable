<?php

/**
 * Test: Carrooi\Labels\Addressable\Facades\AddressesFacade
 *
 * @testCase CarrooiTests\Labels\Addressable\Facades\AddressesFacadeTest
 * @author David Kudera
 */

namespace CarrooiTests\Labels\Model\Facades;

use CarrooiTests\Addressable\TestCase;
use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';

/**
 *
 * @author David Kudera
 */
class AddressesFacadeTest extends TestCase
{


	/** @var \Carrooi\Addressable\Model\Facades\AddressesFacade */
	private $addresses;

	/** @var \CarrooiTests\AddressableApp\Model\Facades\Users */
	private $users;

	/** @var \Kdyby\Doctrine\EntityDao */
	private $dao;


	public function setUp()
	{
		$container = $this->createContainer();

		$this->addresses = $container->getByType('Carrooi\Addressable\Model\Facades\AddressesFacade');
		$this->users = $container->getByType('CarrooiTests\AddressableApp\Model\Facades\Users');
		$this->dao = $container->getByType('Kdyby\Doctrine\EntityManager')->getRepository($this->addresses->getClass());
	}


	public function tearDown()
	{
		$this->addresses = null;
	}


	public function testCreate()
	{
		$address = $this->addresses->create('Prague', 13000, [
			'houseNumber' => 5555,
			'orientationNumber' => '8a',
			'street' => 'Lorem',
		]);

		$user = $this->users->create();
		$user->setAddress($address);

		$this->dao->getEntityManager()->persist($user)->flush();

		Assert::type('Carrooi\Addressable\Model\Entities\IAddress', $address);
		Assert::notSame(null, $address->getId());
		Assert::same('Prague', $address->getCity());
		Assert::same(13000, $address->getPostalCode());
		Assert::same(5555, $address->getHouseNumber());
		Assert::same('8a', $address->getOrientationNumber());
		Assert::same('Lorem', $address->getStreet());

		Assert::true($user->hasAddress());
		Assert::same($address->getId(), $user->getAddress()->getId());
	}


	public function testUpdate()
	{
		$address = $this->addresses->create('Prague', 13000, [
			'houseNumber' => 5555,
			'orientationNumber' => '8a',
			'street' => 'Lorem',
		]);

		$this->addresses->update($address, [
			'city' => 'New York',
			'postalCode' => 88877,
			'houseNumber' => 1212,
			'orientationNumber' => '45',
			'street' => 'Obama\'s street',
		]);

		Assert::same('New York', $address->getCity());
		Assert::same(88877, $address->getPostalCode());
		Assert::same(1212, $address->getHouseNumber());
		Assert::same('45', $address->getOrientationNumber());
		Assert::same('Obama\'s street', $address->getStreet());
	}


	public function testRemove()
	{
		$address = $this->addresses->create('Prague', 13000, [
			'houseNumber' => 5555,
			'orientationNumber' => '8a',
			'street' => 'Lorem',
		]);

		$user = $this->users->create();
		$user->setAddress($address);

		$this->dao->getEntityManager()->persist($user)->flush();

		$this->addresses->remove($address);
		$user->setAddress(null);

		$this->dao->getEntityManager()->persist($user)->flush();

		$address = $this->dao->findOneBy([
			'id' => $address->getId(),
		]);

		$user = $this->users->findOneById($user->getId());

		Assert::null($address);
		Assert::false($user->hasAddress());
	}

}


run(new AddressesFacadeTest);
