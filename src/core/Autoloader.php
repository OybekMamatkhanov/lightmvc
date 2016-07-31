<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/14/2016
 * Time: 11:43 AM
 */
class Autoloader
{
	protected $namespaces = array();

	public function add($namespace, $rootDir)
	{
		if (is_dir($rootDir)) {
			$this->namespaces[$namespace] = $rootDir;
			return true;
		}

		return false;
	}

	public function register()
	{
		spl_autoload_register(array($this, 'autoload'));
	}

	protected function autoload($class)
	{
		$pathParts = explode('\\', $class);

		if (is_array($pathParts)) {
			$namespace = array_shift($pathParts);

			if (!empty($this->namespaces[$namespace])) {
				$filePath = $this->namespaces[$namespace] . '/' . implode('/', $pathParts) . '.php';
				require_once  $filePath;
				return true;
			}
		}
		return false;
	}
}