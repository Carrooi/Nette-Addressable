<?php

/**
 * Test: Carrooi\Addressable\Facades\AddressesFacade
 *
 * @testCase CarrooiTests\Addressable\Facades\AddressesFacadeTest
 * @author David Kudera
 */

namespace CarrooiTests\Addressable\Model\Facades;

use Carrooi\Addressable\Model\DefaultEntities\DefaultAddress;
use Carrooi\Addressable\Model\Facades\AddressesFacade;
use Mockery;
use Tester\Assert;
use Tester\Environment;
use Tester\TestCase;

require_once __DIR__ . '/../../../bootstrap.php';

/**
 *
 * @author David Kudera
 */
class AddressesFacadeTest extends TestCase
{


	public function testCreate()
	{
		$em = Mockery::mock('Kdyby\Doctrine\EntityManager')
			->shouldReceive('getRepository')
			->shouldReceive('persist')->andReturnSelf()
			->shouldReceive('flush')
			->getMock();

		$addresses = new AddressesFacade('Carrooi\Addressable\Model\DefaultEntities\DefaultAddress', $em);

		$address = $addresses->create('Prague', 13000, [
			'houseNumber' => 5555,
			'orientationNumber' => '8a',
			'street' => 'Lorem',
		]);

		Assert::type('Carrooi\Addressable\Model\Entities\IAddress', $address);
		Assert::same('Prague', $address->getCity());
		Assert::same(13000, $address->getPostalCode());
		Assert::same(5555, $address->getHouseNumber());
		Assert::same('8a', $address->getOrientationNumber());
		Assert::same('Lorem', $address->getStreet());
	}


	public function testUpdate()
	{
		$em = Mockery::mock('Kdyby\Doctrine\EntityManager')
			->shouldReceive('getRepository')
			->shouldReceive('flush')
			->getMock();

		$addresses = new AddressesFacade('Carrooi\Addressable\Model\DefaultEntities\DefaultAddress', $em);

		$address = new DefaultAddress;
		$address->setCity('New York');
		$address->setPostalCode(88877);
		$address->setHouseNumber(1212);
		$address->setOrientationNumber('45');
		$address->setStreet('Obama\'s street');

		$addresses->update($address, [
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
		Environment::$checkAssertions = false;

		$em = Mockery::mock('Kdyby\Doctrine\EntityManager')
			->shouldReceive('getRepository')
			->shouldReceive('remove')->andReturnSelf()
			->shouldReceive('flush')
			->getMock();

		$addresses = new AddressesFacade('Carrooi\Addressable\Model\DefaultEntities\DefaultAddress', $em);

		$address = new DefaultAddress;

		$addresses->remove($address);
	}

}


run(new AddressesFacadeTest);
