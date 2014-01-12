<?php
namespace Librette\Flot\Types;

use Librette\Flot\OptionsAware;
use Nette\Object;

/**
 * @author David Matejka
 */
abstract class BaseType extends Object implements IType
{
	use OptionsAware;

	public function __construct()
	{
		$this->enable();
	}


	public function enable()
	{
		$this->setOption('show', TRUE);
	}


	public function disable()
	{
		$this->setOption('show', FALSE);
	}

}