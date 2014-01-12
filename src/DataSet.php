<?php
namespace Librette\Flot;

/**
 * @author David Matejka
 */
class DataSet implements \IteratorAggregate
{

	/** @var array|DataValue[] */
	protected $data = array();

	/** @var int highest index in data array */
	protected $max = 0;


	/**
	 * @param mixed $value
	 * @param mixed $key optional key
	 */
	public function add($value, $key = NULL)
	{
		$key = $this->createKey($key);
		$this->data[$this->createKeyHash($key)] = new DataValue($key, $value);
	}


	public function remove($key)
	{
		if ($this->has($key)) {
			unset($this->data[$this->createKeyHash($key)]);
		}
	}


	public function has($key)
	{
		return isset($this->data[$this->createKeyHash($key)]);
	}


	public function append($values)
	{
		foreach ($values as $key => $value) {
			$this->add($key, $value);
		}
	}


	private function createKey($key)
	{
		if ($key === NULL) {
			return $this->max++;
		}

		if (is_numeric($key) && (int) $key == $key) {
			$this->max = max($this->max, $key);
		}

		return $key;
	}


	private function createKeyHash($key)
	{
		return is_scalar($key) ? $key : md5(serialize($key));
	}


	/**
	 * @return \ArrayIterator|DataValue[]
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->data);
	}

}