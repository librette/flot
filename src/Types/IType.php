<?php
namespace Librette\Flot\Types;

/**
 * @author David Matejka
 */
interface IType
{

	/**
	 * @return string
	 */
	public function getIdentifier();


	/**
	 * @return array
	 */
	public function getOptions();
}