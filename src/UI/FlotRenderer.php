<?php
namespace Librette\Flot\UI;

use Librette\Flot;
use Nette\Utils;
use Nette\Object;


/**
 * @author David Matejka
 */
class FlotRenderer extends Object implements IRenderer
{

	const PLOT_METHOD = '$(function() { $.plot(%s);});';


	/**
	 * @param Flot\Plot $plot
	 * @return Utils\Html|string
	 */
	public function renderDiv(Flot\Plot $plot)
	{
		return Utils\Html::el('div')->id($plot->getName())->style('width:100%;height:100%');
	}


	/**
	 * @param Flot\Plot $plot
	 * @return string
	 */
	public function renderJavascript(Flot\Plot $plot)
	{
		$args = array();
		$args[] = Utils\Json::encode('#' . $plot->getName());
		$args[] = Utils\Json::encode($this->exportData($plot));
		$args[] = Utils\Json::encode($this->exportOptions($plot));

		return sprintf(self::PLOT_METHOD, implode(', ', $args));
	}


	protected function exportData(Flot\Plot $plot)
	{
		$dataSeriesList = array();
		foreach ($plot->getDataSeries() as $dataSeries) {
			$dataSeriesList[] = $this->exportDataSeriesOptions($dataSeries);
		}

		return $dataSeriesList;
	}


	protected function exportDataSeriesOptions(Flot\DataSeries $dataSeries)
	{
		$options = $dataSeries->getOptions();
		$data = iterator_to_array($dataSeries->getData());
		$options['data'] = array_map(function (Flot\DataValue $value) {
			if ($value->key instanceof \DateTime) {
				$timestamp = (int) $value->key->format('U') + timezone_offset_get($value->key->getTimezone(), $value->key);

				return [$timestamp * 1000, (float) $value->value];
			} else {
				return [(int) $value->key, (float) $value->value];
			}
		}, array_values($data));
		foreach ($dataSeries->getTypes() as $type) {
			$options[$type->getIdentifier()] = $this->exportTypeOptions($type);
		}

		return $options;
	}


	protected function exportTypeOptions(Flot\Types\IType $type)
	{
		return $type->getOptions();
	}


	protected function exportOptions(Flot\Plot $plot)
	{
		$options = array();
		foreach (array('xaxes' => $plot->getXAxes(), 'yaxes' => $plot->getYAxes()) as $axeName => $axes) {
			foreach ($axes as $axe) {
				$options[$axeName][] = $this->exportAxisOptions($axe);
			}
		}
		$options['grid'] = $this->exportGridOptions($plot->getGrid());
		$options['legend'] = $this->exportLegendOptions($plot->getLegend());
		$options += $plot->getOptions();

		return $options;
	}


	protected function exportAxisOptions(Flot\Axis $axis)
	{
		return $axis->getOptions();
	}


	protected function exportGridOptions(Flot\Grid $grid)
	{
		return $grid->getOptions();
	}


	protected function exportLegendOptions(Flot\Legend $legend)
	{
		return $legend->getOptions();
	}
}