<?php

namespace Carrooi\Addressable\Model\DefaultEntities;

use Carrooi\Addressable\Model\Entities\IAddress;
use Carrooi\Addressable\Model\Entities\TAddress;
use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Entities\Attributes\Identifier;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="address")
 *
 * @author David Kudera
 */
class DefaultAddress implements IAddress
{


	use Identifier;

	use TAddress;

}
