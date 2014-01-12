<?php
namespace Librette\Flot;

/**
 * @author David Matejka
 */
class DataValue
{

	/** @var mixed */
	public $key;

	/** @var mixed */
	public $value;


	/**
	 * @param mixed $key
	 * @param mixed $value
	 */
	public function __construct($key, $value)
	{
		$this->key = $key;
		$this->value = $value;
	}
}