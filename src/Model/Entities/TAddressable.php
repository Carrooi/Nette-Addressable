<?php

namespace Carrooi\Addressable\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author David Kudera
 */
trait TAddressable
{


	/**
	 * @ORM\ManyToOne(targetEntity="\Carrooi\Addressable\Model\Entities\IAddress")
	 * @ORM\JoinColumn(nullable=true)
	 * @var \Carrooi\Addressable\Model\Entities\IAddress
	 */
	private $address;


	/**
	 * @return bool
	 */
	public function hasAddress()
	{
		return $this->address !== null;
	}


	/**
	 * @return \Carrooi\Addressable\Model\Entities\IAddress
	 */
	public function getAddress()
	{
		return $this->address;
	}


	/**
	 * @param \Carrooi\Addressable\Model\Entities\IAddress $address
	 * @return $this
	 */
	public function setAddress(IAddress $address = null)
	{
		$this->address = $address;
		return $this;
	}

}
