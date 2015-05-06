<?php

namespace Carrooi\Addressable\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author David Kudera
 */
trait TAddress
{


	/**
	 * @ORM\Column(type="string", length=150, nullable=true)
	 * @var string
	 */
	private $street;


	/**
	 * @ORM\Column(type="string", length=80, nullable=false)
	 * @var string
	 */
	private $city;


	/**
	 * @ORM\Column(type="integer", length=5, nullable=false)
	 * @var int
	 */
	private $postalCode;


	/**
	 * @ORM\Column(type="integer", length=6, nullable=true)
	 * @var int
	 */
	private $houseNumber;

	/**
	 * @ORM\Column(type="string", length=5, nullable=true)
	 * @var string
	 */
	private $orientationNumber;


	/**
	 * @return bool
	 */
	public function hasStreet()
	{
		return $this->street !== null;
	}


	/**
	 * @return string
	 */
	public function getStreet()
	{
		return $this->street;
	}


	/**
	 * @param string $street
	 * @return $this
	 */
	public function setStreet($street)
	{
		$this->street = $street;
		return $this;
	}


	/**
	 * @return string
	 */
	public function getCity()
	{
		return $this->city;
	}


	/**
	 * @param string $city
	 * @return $this
	 */
	public function setCity($city)
	{
		$this->city = $city;
		return $this;
	}


	/**
	 * @return int
	 */
	public function getPostalCode()
	{
		return $this->postalCode;
	}


	/**
	 * @param int $postalCode
	 * @return $this
	 */
	public function setPostalCode($postalCode)
	{
		$this->postalCode = $postalCode;
		return $this;
	}


	/**
	 * @return bool
	 */
	public function hasHouseNumber()
	{
		return $this->houseNumber !== null;
	}


	/**
	 * @return int
	 */
	public function getHouseNumber()
	{
		return $this->houseNumber;
	}


	/**
	 * @param int $houseNumber
	 * @return $this
	 */
	public function setHouseNumber($houseNumber)
	{
		$this->houseNumber = $houseNumber;
		return $this;
	}


	/**
	 * @return bool
	 */
	public function hasOrientationNumber()
	{
		return $this->orientationNumber !== null;
	}


	/**
	 * @return int
	 */
	public function getOrientationNumber()
	{
		return $this->orientationNumber;
	}


	/**
	 * @param int $orientationNumber
	 * @return $this
	 */
	public function setOrientationNumber($orientationNumber)
	{
		$this->orientationNumber = $orientationNumber;
		return $this;
	}

}
