<?php
namespace Librette\Flot;

use Librette\Flot\Types\IType;
use Nette\Object;

/**
 * @author David Matejka
 */
class DataSeries extends Object
{

	use OptionsAware;

	/** @var DataSet */
	protected $data;


	/** @var IType[] */
	protected $types;


	/**
	 * @param array|\Traversable $data
	 * @param null $label
	 */
	public function __construct($data = array(), $label = NULL)
	{
		if ($data instanceof \Traversable) {
			$data = iterator_to_array($data);
		}
		$this->setLabel($label);
		$this->data = new DataSet();
		if (!empty($data)) {
			$this->data->append($data);
		}
	}


	/**
	 * @param IType $plotType
	 */
	public function addType(IType $plotType)
	{
		$this->types[$plotType->getIdentifier()] = $plotType;
	}


	/**
	 * @param string $identifier type identifier (ie: line, point, bar...)
	 * @return IType|NULL
	 */
	public function getType($identifier)
	{
		return isset($this->types[$identifier]) ? $this->types[$identifier] : NULL;
	}


	/**
	 * @return Types\IType[]
	 */
	public function getTypes()
	{
		return $this->types;
	}


	/**
	 * Adds value to data set
	 *
	 * @param mixed $value
	 * @param mixed $key optional key, integer is recommended
	 */
	public function add($value, $key = NULL)
	{
		$this->data->add($value, $key);
	}


	/**
	 * @param array|\Traversable $data data to be appended to current data set
	 */
	public function append($data)
	{
		$this->data->append($data);
	}


	/**
	 * @return DataSet
	 */
	public function getData()
	{
		return $this->data;
	}


	/**
	 * @param string $label
	 */
	public function setLabel($label)
	{
		$this->setOption('label', $label);
	}


	/**
	 * @return string
	 */
	public function getLabel()
	{
		return $this->getOption('label');
	}

}