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

	protected $prefix;

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
	 * @return string
	 */
	public function getLanguage()
	{
		return $this->language;
	}

	public function getRoute()
	{
		return $this->route;
	}

	/**
	 * Route constructor.
	 * @param uri
	 */
	public function __construct($uri)
	{
		$this->uri = urldecode(trim($uri, '/'));
		$this->language = 'en';
		$this->route = 'default';
		$routes = array( 'default' => '', 'profile' => 'user' );

		$uri = explode('?', $this->uri);

		$path = $uri[0];

		$pathParts = explode('/', $path);

		if ( count($pathParts) ) {

			if ( in_array(strtolower(current($pathParts)), array_keys($routes)) ) {
				$this->route = strtolower(current($pathParts));
				$this->prefix =  isset($routes[$this->route]) ? $routes[$this->route] : '';
				$this->language = strtolower(current($pathParts));
				array_shift($pathParts);
			} else if ( in_array(strtolower(current($pathParts)), Config::getSettings('lang')) ) {
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

	public static function redirect($uri)
	{
		header("Location: ".$uri);
		exit();
	}

}