<?php
namespace Librette\Flot;

use Nette\Object;

/**
 * @author David Matejka
 */
class Legend extends Object
{
	const POSITION_TOP_LEFT = 'nw';
	const POSITION_TOP_RIGHT = 'ne';
	const POSITION_BOTTOM_LEFT = 'sw';
	const POSITION_BOTTOM_RIGHT = 'se';

	use OptionsAware;

	public function __construct()
	{
		$this->setOption('show', true);
	}

}