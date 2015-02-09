# Carrooi/Addressable

[![Build Status](https://img.shields.io/travis/Carrooi/Nette-Addressable.svg?style=flat-square)](https://travis-ci.org/Carrooi/Nette-Addressable)
[![Donate](https://img.shields.io/badge/donate-PayPal-brightgreen.svg?style=flat-square)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SZRZJA7TCK4N2)

Addressable module for Nette framework and Doctrine.

## Installation

```
$ composer require carrooi/addressable
$ composer update
```

## Usage

Imagine that you want to be able to add address to `User` entity.

```php
namespace App\Model\Entities;

use Carrooi\Addressable\Model\Entities\IAddressableEntity;
use Carrooi\Addressable\Model\Entities\TAddressable;
use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Entities\Attributes\Identifier;
use Kdyby\Doctrine\Entities\BaseEntity;

/**
 * @ORM\Entity
 * @author David Kudera
 */
class User extends BaseEntity implements IAddressableEntity
{

	use Identifier;

	use TAddressable;

}
```

Users facade:

```php
namespace App\Model\Facades;

use Carrooi\Addressable\Model\Facades\AddressesFacade;

/**
 * @author David Kudera
 */
class UsersFacade
{

	/** @var \Kdyby\Doctrine\EntityManager */
	private $em;

	/** @var \Carrooi\Addressable\Model\Facades\AddressesFacade */
	private $addressesFacade;

	/**
	 * @param \Kdyby\Doctrine\EntityManager $em
	 * @param \Carrooi\Addressable\Model\Facades\AddressesFacade $addressesFacade
	 */
	public function __construct(EntityManager $em, AddressesFacade $addressesFacade)
	{
		$this->em = $em;
		$this->addressesFacade = $addressesFacade;
	}

	/**
	 * @param \App\Model\Entities\User $user
	 * @param string $city
	 * @param int $postalCode
	 * @param int $houseNumber
	 * @param array $values
	 */
	public function addAddress(User $user, $city, $postalCode, $houseNumber, arra $values = [])
	{
		$address = $this->addressesFacade->create($city, $postalCode, $houseNumber, $values);

		$user->setAddress($address);

		$this->em->persist($user)->flush();

		return $this;
	}

	/**
	 * @param \App\Model\Entities\User $user
	 */
	public function removeAddress(User $user)
	{
		$this->addressesFacade->remove($user->getAddress());
		$user->setAddress(null);

		$this->em->persist($user)->flush();

		return $this;
	}

}
```

Usage:

```php
/** @var \App\Model\Facades\UsersFacade @inject */
public $usersFacade;

/** @var \Carrooi\Addressable\Model\Facades\AddressesFacade @inject */
public $addressesFacade;

public function actionAdd()
{
	$user = getUserSomehow();
	
	$this->usersFacade->addAddress($user, 'Prague', 13000, 555, [
		'orientationNumber' => '8b',
		'street' => 'Lorem ipsum',
	]);
}

public function actionEdit()
{
	$user = getUserSomehow();
	$address = $user->getAddress();

	$this->addressesFacade->update($address, [
		'city' => 'New York',
		'postalCode' => 88877,
		'houseNumber' => 1212,
		'orientationNumber' => 45,
		'street' => 'Ipsum',
	]);
}

public function actionRemove()
{
	$user = getUserSomehow();

	$this->usersFacade->removeAddress($user);
}
```

And that's it :)

## Changelog

* 1.0.0
	+ Initial version
