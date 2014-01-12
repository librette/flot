<?php
namespace Librette\Flot;

use Nette\Object;

/**
 * @author David Matejka
 */
class PluginLoader extends Object
{

	const FILENAME_MIN_VERSION = 'jquery.flot.%s.min.js';
	const FILENAME_FULL_VERSION = 'jquery.flot.%s.js';

	const PLUGIN_CANVAS = 'canvas';
	const PLUGIN_CATEGORIES = 'categories';
	const PLUGIN_CROSSHAIR = 'crosshair';
	const PLUGIN_ERROR_BARS = 'errorbars';
	const PLUGIN_FILL_BETWEEN = 'fillbetween';
	const PLUGIN_IMAGE = 'image';
	const PLUGIN_NAVIGATE = 'navigate';
	const PLUGIN_PIE = 'pie';
	const PLUGIN_RESIZE = 'resize';
	const PLUGIN_SELECTION = 'selection';
	const PLUGIN_STACK = 'stack';
	const PLUGIN_SYMBOL = 'symbol';
	const PLUGIN_THRESHOLD = 'threshold';
	const PLUGIN_TIME = 'time';

	/** @var array */
	protected $plugins = array();


	/**
	 * @param string|array $plugin
	 * @return self
	 */
	public function load($plugin)
	{
		if(!is_array($plugin)) {
			$plugin = func_get_args();
		}
		foreach($plugin as $name) {
			if(!in_array($name, $this->plugins)) {
				$this->plugins[] = $name;
			}
		}

		return $this;
	}


	/**
	 * @param string $name
	 * @return self
	 */
	public function unload($name)
	{
		if(($key = array_search($name, $this->plugins)) !== FALSE) {
			unset($this->plugins[$key]);
		}

		return $this;
	}


	/**
	 * @return array
	 */
	public function getLoadedPlugins()
	{
		return $this->plugins;
	}


	/**
	 * @param string $basePath
	 * @param string $filenameFormat
	 * @return array of required js plugins
	 */
	public function export($basePath = '/', $filenameFormat = self::FILENAME_MIN_VERSION)
	{
		$basePath = rtrim($basePath, '/');

		return array_map(function ($plugin) use ($basePath, $filenameFormat) {
			return $basePath . '/' . ltrim(sprintf($filenameFormat, $plugin));
		}, $this->getLoadedPlugins());
	}
}