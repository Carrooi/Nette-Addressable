<?php

namespace CarrooiTests\AddressableApp\Model\Entities;

use Carrooi\Addressable\Model\Entities\IAddressableEntity;
use Carrooi\Addressable\Model\Entities\TAddressable;
use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Entities\Attributes\Identifier;
use Kdyby\Doctrine\Entities\BaseEntity;

/**
 *
 * @ORM\Entity
 *
 * @author David Kudera
 */
class User extends BaseEntity implements IAddressableEntity
{


	use Identifier;

	use TAddressable;

}
