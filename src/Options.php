<?php
namespace Librette\Flot;

/**
 * @author David Matejka
 */
class Options implements \ArrayAccess
{

	protected $options = array();


	public function setOption($key, $value)
	{
		$args = func_get_args();
		$value = array_pop($args);
		$option = & $this->options;
		foreach ($args as $key) {
			$option = & $option[$key];
		}
		$option = $value;
	}


	public function getOption($key)
	{
		$args = func_get_args();
		$value = $this->options;
		foreach ($args as $key) {
			if (!array_keys($value, $key)) {
				return NULL;
			}
			$value = $value[$key];
		}

		return $value;
	}


	/**
	 * @return array
	 */
	public function getOptions()
	{
		return $this->options;
	}


	public function offsetExists($offset)
	{
		return array_key_exists($offset, $this->options);
	}


	public function offsetGet($offset)
	{
		return $this->options[$offset];
	}


	public function offsetSet($offset, $value)
	{
		$this->options[$offset] = $value;
	}


	public function offsetUnset($offset)
	{
		unset($this->options[$offset]);
	}

}