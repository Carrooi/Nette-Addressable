<?php

/**
 * Test: Carrooi\Addressable\Entities\TAddress
 *
 * @testCase CarrooiTests\Addressable\Entities\TAddressTest
 * @author David Kudera
 */

namespace CarrooiTests\Addressable\Model\Entities;

use Carrooi\Addressable\Model\DefaultEntities\DefaultAddress;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../../bootstrap.php';

/**
 *
 * @author David Kudera
 */
class TAddressTest extends TestCase
{


	public function testStreet()
	{
		$address = new DefaultAddress;

		Assert::false($address->hasStreet());

		$address->setStreet('test');

		Assert::true($address->hasStreet());
		Assert::same('test', $address->getStreet());
	}


	public function testCity()
	{
		$address = new DefaultAddress;

		Assert::null($address->getCity());

		$address->setCity('test');

		Assert::same('test', $address->getCity());
	}


	public function testPostalCode()
	{
		$address = new DefaultAddress;

		Assert::null($address->getPostalCode());

		$address->setPostalCode(88888);

		Assert::same(88888, $address->getPostalCode());
	}


	public function testHouseNumber()
	{
		$address = new DefaultAddress;

		Assert::false($address->hasHouseNumber());

		$address->setHouseNumber(5);

		Assert::true($address->hasHouseNumber());
		Assert::same(5, $address->getHouseNumber());
	}


	public function testOrientationNumber()
	{
		$address = new DefaultAddress;

		Assert::false($address->hasOrientationNumber());

		$address->setOrientationNumber(20);

		Assert::true($address->hasOrientationNumber());
		Assert::same(20, $address->getOrientationNumber());
	}

}


run(new TAddressTest);
