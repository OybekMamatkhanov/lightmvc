<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/1/2016
 * Time: 3:20 PM
 */

namespace Src\Core;

use Src\Core\Contracts\RouterInterface;
use Src\Core\Controller;

class App
{

	protected static $router;

	/**
	 * @return mixed
	 */
	public static function getRouter()
	{
		return self::$router;
	}

	public static function run(RouterInterface $router)
	{
		self::$router = $router;

		$controllerClass = ucfirst(self::$router->getController()) . 'Controller';
		$actionMethod = 'action' . ucfirst(self::$router->getAction());

		$modelFile = ucfirst($controllerClass).'.php';
		$modelPath = "src/Model/".$modelFile;

		try {
			if (file_exists($modelPath)) {
				include "src/Model/" . $modelFile;
			}

			$controllerFile = ucfirst($controllerClass) . '.php';
			$controllerPath = "src/Controller/" . $controllerFile;

			if (file_exists($controllerPath)) {
				include "src/Controller/" . $controllerFile;
			}
		} catch (\Exception $e){

			echo $e->getMessage();

		}

		$controller = new $controllerClass();

		try {
			if ( method_exists($controller, $actionMethod) ) {
				$result = $controller->$actionMethod();
			}
		} catch ( \Exception $e ) {
			$e->getMessage();
		}

	}
}