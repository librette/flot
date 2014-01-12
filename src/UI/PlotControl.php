<?php
namespace Librette\Flot\UI;

use Librette\Flot\Plot;
use Nette\Application\UI\Control;

/**
 * @author David Matejka
 */
class PlotControl extends Control
{

	/** @var \Librette\Flot\Plot */
	protected $plot;

	/** @var IRenderer */
	protected $renderer;


	/**
	 * @param Plot $plot
	 */
	public function __construct(Plot $plot = NULL)
	{
		$this->plot = $plot;
	}


	/**
	 * @param \Librette\Flot\Plot $plot
	 */
	public function setPlot(Plot $plot)
	{
		$this->plot = $plot;
	}


	/**
	 * @return \Librette\Flot\Plot
	 */
	public function getPlot()
	{
		return $this->plot ? : $this->plot = new Plot();
	}


	/**
	 * @param \Librette\Flot\UI\IRenderer $renderer
	 */
	public function setRenderer(IRenderer $renderer)
	{
		$this->renderer = $renderer;
	}


	/**
	 * @return IRenderer
	 */
	public function getRenderer()
	{
		if ($this->renderer === NULL) {
			$this->renderer = new FlotRenderer();
		}

		return $this->renderer;
	}


	public function render()
	{
		$this->template->setFile(__DIR__ . '/plot.latte');
		$this->template->plot = $this->getPlot();
		$this->template->renderer = $this->getRenderer();
		$this->template->render();
	}
}