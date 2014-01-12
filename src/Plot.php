<?php
namespace Librette\Flot;

use Librette\Flot\Types\Bar;
use Librette\Flot\Types\Line;
use Librette\Flot\Types\Point;
use Nette\Object;

/**
 * @author David Matejka
 */
class Plot extends Object
{

	use OptionsAware;

	/** @var DataSeries[] */
	protected $dataSeries = array();

	/** @var \Librette\Flot\Legend */
	protected $legend;

	/** @var Grid */
	protected $grid;

	/** @var Axis[] */
	protected $xAxes;

	/** @var Axis[] */
	protected $yAxes;

	/** @var Axis */
	protected $defaultXAxis;

	/** @var Axis */
	protected $defaultYAxis;

	/** @var \Librette\Flot\PluginLoader */
	protected $pluginLoader;

	/** @var string */
	protected $name;


	/**
	 * @param string $name optional plot name, if not specified, "random" name is used
	 */
	public function __construct($name = NULL)
	{
		$this->name = $name ? : uniqid('flot-');
		$this->legend = new Legend();
		$this->grid = new Grid();
		$this->addXAxis(new Axis(), TRUE);
		$this->addYAxis(new Axis(), TRUE);
		$this->pluginLoader = new PluginLoader();
	}


	/**
	 * @return \Librette\Flot\Grid
	 */
	public function getGrid()
	{
		return $this->grid;
	}


	/**
	 * @return \Librette\Flot\Legend
	 */
	public function getLegend()
	{
		return $this->legend;
	}


	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}


	/**
	 * @return \Librette\Flot\PluginLoader
	 */
	public function getPluginLoader()
	{
		return $this->pluginLoader;
	}


	/**
	 * @param Axis $axis
	 * @param bool $default
	 */
	public function addYAxis(Axis $axis, $default = FALSE)
	{
		$this->yAxes[] = $axis;
		if ($default) {
			$this->defaultYAxis = $axis;
		}
	}


	/**
	 * @param Axis $axis
	 * @param bool $default
	 */
	public function addXAxis(Axis $axis, $default = FALSE)
	{
		$this->xAxes[] = $axis;
		if ($default) {
			$this->defaultXAxis = $axis;
		}
	}


	/**
	 * @return \Librette\Flot\Axis[]
	 */
	public function getXAxes()
	{
		return $this->xAxes;
	}


	/**
	 * @return \Librette\Flot\Axis[]
	 */
	public function getYAxes()
	{
		return $this->yAxes;
	}


	/**
	 * @return \Librette\Flot\Axis
	 */
	public function getDefaultXAxis()
	{
		return $this->defaultXAxis;
	}


	/**
	 * @return \Librette\Flot\Axis
	 */
	public function getDefaultYAxis()
	{
		return $this->defaultYAxis;
	}


	/**
	 * @return \Librette\Flot\DataSeries[]
	 */
	public function getDataSeries()
	{
		return $this->dataSeries;
	}


	/**
	 * @param array|\Traversable $data
	 * @param string $label optional data series label
	 * @return DataSeries
	 */
	public function addDataSeries($data = array(), $label = NULL)
	{
		$dataSeries = new DataSeries($data, $label);
		$this->dataSeries[] = $dataSeries;

		return $dataSeries;
	}


	/**
	 * @param array|\Traversable $data
	 * @param string $label optional data series label
	 * @return DataSeries
	 */
	public function addBar($data = array(), $label = NULL)
	{
		$dataSeries = $this->addDataSeries($data, $label);
		$dataSeries->addType(new Bar());

		return $dataSeries;
	}


	/**
	 * @param array|\Traversable $data
	 * @param string $label optional data series label
	 * @return DataSeries
	 */
	public function addLine($data = array(), $label = NULL)
	{
		$dataSeries = $this->addDataSeries($data, $label);
		$dataSeries->addType(new Line());

		return $dataSeries;
	}


	/**
	 * @param array|\Traversable $data
	 * @param string $label optional data series label
	 * @return DataSeries
	 */
	public function addPoints($data = array(), $label = NULL)
	{
		$dataSeries = $this->addDataSeries($data, $label);
		$dataSeries->addType(new Point());

		return $dataSeries;
	}

}
