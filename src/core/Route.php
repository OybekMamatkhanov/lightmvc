<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/14/2016
 * Time: 2:20 PM
 */
namespace Src\Core;

use Src\Core\Config;
use Src\Core\Contracts\RouterInterface;

class Route implements RouterInterface
{

	protected $uri;

	protected $controller = 'Site';

	protected $action = 'index';

	protected $language;

	public $route;

	protected $params;

	/**
	 * @return mixed
	 */

	public function getUri()
	{
		return $this->uri;
	}

	/**
	 * @return mixed
	 */
	public function getController()
	{
		return $this->controller;
	}

	/**
	 * @return mixed
	 */
	public function getAction()
	{
		return $this->action;
	}

	/**
	 * @return mixed
	 */
	public function getParams()
	{
		return $this->params;
	}

	/**
	 * Route constructor.
	 * @param uri
	 */
	public function __construct($uri)
	{
		$this->uri = urldecode(trim($uri, '/'));
		$this->language = Config::getSettings('lang');

		$routes = explode('?', $this->uri);

		$path = $routes[0];

		$pathParts = explode('/', $path);

		if ( count($pathParts) ) {

			if ( in_array(strtolower(current($pathParts)), array('language' => Config::getSettings('lang'))) ) {
				$this->language = strtolower(current($pathParts));
				array_shift($pathParts);
			}

			if ( current($pathParts) ) {
				$this->controller = strtolower(current($pathParts));
				array_shift($pathParts);
		}

			if ( current($pathParts) ) {
				$this->action = strtolower(current($pathParts));
				array_shift($pathParts);
			}

			$this->params = $pathParts;
		}
	}

}