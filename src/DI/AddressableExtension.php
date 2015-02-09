<?php

namespace Carrooi\Addressable\DI;

use Carrooi\Addressable\ConfigurationException;
use Kdyby\Doctrine\DI\IEntityProvider;
use Kdyby\Doctrine\DI\ITargetEntityProvider;
use Kdyby\Events\DI\EventsExtension;
use Nette\DI\CompilerExtension;

/**
 *
 * @author David Kudera
 */
class AddressableExtension extends CompilerExtension implements IEntityProvider, ITargetEntityProvider
{


	/** @var array */
	private $defaults = [
		'addressClass' => 'Carrooi\Addressable\Model\DefaultEntities\DefaultAddress',
	];


	/** @var string */
	private $addressClass;


	public function loadConfiguration()
	{
		$config = $this->getConfig($this->defaults);
		$builder = $this->getContainerBuilder();

		if (!class_exists($config['addressClass'])) {
			throw new ConfigurationException('Class '. $config['addressClass']. ' does not exists.');
		}

		$this->addressClass = $config['addressClass'];

		$builder->addDefinition($this->prefix('facade.addresses'))
			->setClass('Carrooi\Addressable\Model\Facades\AddressesFacade')
			->setArguments([$this->addressClass]);
	}


	/**
	 * @return array
	 */
	function getEntityMappings()
	{
		$mappings = [
			'Carrooi\Addressable\Model\Entities' => __DIR__. '/../Model/Entities',
		];

		if ($this->addressClass === 'Carrooi\Addressable\Model\DefaultEntities\DefaultAddress') {
			$mappings['Carrooi\Addressable\Model\DefaultEntities'] = __DIR__. '/../Model/DefaultEntities';
		}

		return $mappings;
	}


	/**
	 * @return array
	 */
	function getTargetEntityMappings()
	{
		return [
			'Carrooi\Addressable\Model\Entities\IAddress' => $this->addressClass,
		];
	}

}
