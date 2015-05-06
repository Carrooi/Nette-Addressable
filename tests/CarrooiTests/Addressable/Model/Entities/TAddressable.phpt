<?php

/**
 * Test: Carrooi\Labels\Addressable\Entities\TAddressable
 *
 * @testCase CarrooiTests\Labels\Addressable\Entities\TAddressableTest
 * @author David Kudera
 */

namespace CarrooiTests\Labels\Model\Entities;

use Carrooi\Addressable\Model\DefaultEntities\DefaultAddress;
use Carrooi\Addressable\Model\Entities\TAddressable;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../../bootstrap.php';

/**
 *
 * @author David Kudera
 */
class TAddressableTest extends TestCase
{


	public function testAddress()
	{
		$user = new User;

		Assert::false($user->hasAddress());

		$address = new DefaultAddress;
		$user->setAddress($address);

		Assert::true($user->hasAddress());
		Assert::same($address, $user->getAddress());
	}

}


/**
 *
 * @author David Kudera
 */
class User
{

	use TAddressable;

}


run(new TAddressableTest);
