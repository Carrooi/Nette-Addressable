<?php

namespace Carrooi\Addressable\Model\Facades;

use Carrooi\Addressable\Model\Entities\IAddress;
use Kdyby\Doctrine\EntityManager;
use Nette\Object;

/**
 *
 * @author David Kudera
 */
class AddressesFacade extends Object
{


	/** @var \Kdyby\Doctrine\EntityManager */
	private $em;

	/** @var \Kdyby\Doctrine\EntityRepository */
	private $dao;

	/** @var string */
	private $class;


	/**
	 * @param string $class
	 * @param \Kdyby\Doctrine\EntityManager $em
	 */
	public function __construct($class, EntityManager $em)
	{
		$this->em = $em;
		$this->class = $class;

		$this->dao = $em->getRepository($class);
	}


	/**
	 * @return string
	 */
	public function getClass()
	{
		return $this->class;
	}


	/**
	 * @return \Carrooi\Addressable\Model\Entities\IAddress
	 */
	public function createEntity()
	{
		$class = $this->getClass();
		return new $class;
	}


	/**
	 * @param string $city
	 * @param int $postalCode
	 * @param array $values
	 * @return \Carrooi\Addressable\Model\Entities\IAddress
	 */
	public function create($city, $postalCode, array $values = [])
	{
		$address = $this->createEntity();

		$address->setCity($city);
		$address->setPostalCode($postalCode);

		if (array_key_exists('street', $values)) {
			$address->setStreet($values['street']);
		}

		if (array_key_exists('houseNumber', $values)) {
			$address->setHouseNumber($values['houseNumber']);
		}

		if (array_key_exists('orientationNumber', $values)) {
			$address->setOrientationNumber($values['orientationNumber']);
		}

		$this->em->persist($address)->flush($address);

		return $address;
	}


	/**
	 * @param \Carrooi\Addressable\Model\Entities\IAddress $address
	 * @param array $values
	 * @return $this
	 */
	public function update(IAddress $address, array $values)
	{
		if (array_key_exists('city', $values)) {
			$address->setCity($values['city']);
		}

		if (array_key_exists('postalCode', $values)) {
			$address->setPostalCode($values['postalCode']);
		}

		if (array_key_exists('houseNumber', $values)) {
			$address->setHouseNumber($values['houseNumber']);
		}

		if (array_key_exists('street', $values)) {
			$address->setStreet($values['street']);
		}

		if (array_key_exists('orientationNumber', $values)) {
			$address->setOrientationNumber($values['orientationNumber']);
		}

		$this->em->flush();

		return $this;
	}


	/**
	 * @param \Carrooi\Addressable\Model\Entities\IAddress $address
	 * @return $this
	 */
	public function remove(IAddress $address)
	{
		$this->em->remove($address)->flush();
		return $this;
	}

}
