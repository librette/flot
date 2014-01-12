<?php
namespace Librette\Flot\UI;

use Librette\Flot\Plot;
use Nette\Utils\Html;

/**
 * @author David Matejka
 */
interface IRenderer
{

	/**
	 * @param Plot $plot
	 * @return Html|string
	 */
	public function renderDiv(Plot $plot);


	/**
	 * @param Plot $plot
	 * @return string
	 */
	public function renderJavascript(Plot $plot);
}