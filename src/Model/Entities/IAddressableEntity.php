<?php

namespace Carrooi\Addressable\Model\Entities;

/**
 *
 * @author David Kudera
 */
interface IAddressableEntity
{


	/**
	 * @return int
	 */
	public function getId();


	/**
	 * @return bool
	 */
	public function hasAddress();


	/**
	 * @return \Carrooi\Addressable\Model\Entities\IAddress
	 */
	public function getAddress();


	/**
	 * @param \Carrooi\Addressable\Model\Entities\IAddress $address
	 * @return $this
	 */
	public function setAddress(IAddress $address);

}
