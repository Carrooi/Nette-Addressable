<?php

namespace Carrooi\Addressable\Model\Entities;

/**
 *
 * @author David Kudera
 */
interface IAddress
{


	/**
	 * @return int
	 */
	public function getId();


	/**
	 * @return bool
	 */
	public function hasStreet();


	/**
	 * @return string
	 */
	public function getStreet();


	/**
	 * @param string $street
	 * @return $this
	 */
	public function setStreet($street);


	/**
	 * @return string
	 */
	public function getCity();


	/**
	 * @param string $city
	 * @return $this
	 */
	public function setCity($city);


	/**
	 * @return int
	 */
	public function getPostalCode();


	/**
	 * @param int $postalCode
	 * @return $this
	 */
	public function setPostalCode($postalCode);


	/**
	 * @return int
	 */
	public function getHouseNumber();


	/**
	 * @param int $houseNumber
	 * @return $this
	 */
	public function setHouseNumber($houseNumber);


	/**
	 * @return bool
	 */
	public function hasOrientationNumber();


	/**
	 * @return int
	 */
	public function getOrientationNumber();


	/**
	 * @param int $orientationNumber
	 * @return $this
	 */
	public function setOrientationNumber($orientationNumber);

}
