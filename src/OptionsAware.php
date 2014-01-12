<?php
namespace Librette\Flot;

/**
 * @author David Matejka
 */
trait OptionsAware
{

	/** @var Options */
	protected $options;


	/**
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function setOption($key, $value)
	{
		$this->initializeOptions();
		call_user_func_array(array($this->options, 'setOption'), func_get_args());

		return $this;
	}


	/**
	 * @param string $key
	 * @return mixed
	 */
	public function getOption($key)
	{
		$this->initializeOptions();

		return call_user_func_array(array($this->options, 'getOption'), func_get_args());
	}


	/**
	 * @return array
	 */
	public function getOptions()
	{
		$this->initializeOptions();

		return $this->options->getOptions();
	}


	protected function initializeOptions()
	{
		if ($this->options === NULL) {
			$this->options = new Options();
		}
	}
}