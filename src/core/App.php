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
use Src\Core\DB;

class App
{

	protected static $router;

	public static $db;

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

		self::$db =  DB::getConnection();

		Language::load(self::$router->getLanguage());

		$route = self::$router->getUri();

		$controllerClass = ucfirst(self::$router->getController()) . 'Controller';
		$actionMethod = 'action' . ucfirst(self::$router->getAction());

		if( $route == 'site/admin' && Session::get('role') != 1 ) {
			Route::redirect('/site/signin');
		}

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