<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/14/2016
 * Time: 2:20 PM
 */
namespace Src\Core;

class Route
{
	static function handle()
	{
		// контроллер и действие по умолчанию
		$controllerName = 'Site';
		$actionName = 'index';

		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{
			$controllerName = $routes[1];
		}

		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$actionName = $routes[2];
		}

		// добавляем префиксы
		$modelName = ucfirst($controllerName);
		$controllerName = ucfirst($controllerName).'Controller';
		$actionName = 'action'.ucfirst($actionName);

		// подцепляем файл с классом модели (файла модели может и не быть)

		$modelFile = ucfirst($modelName).'.php';
		$modelPath = "src/Model/".$modelFile;
		try {
			if (file_exists($modelPath)) {
				include "src/Model/" . $modelFile;
			}

			// подцепляем файл с классом контроллера
			$controllerFile = ucfirst($controllerName) . '.php';
			$controllerPath = "src/Controller/" . $controllerFile;
			if (file_exists($controllerPath)) {
				include "src/Controller/" . $controllerFile;
			}
		} catch (\Exception $e){

			echo $e->getMessage();

		}
		//var_dump($controllerName);
		// создаем контроллер
		$controller = new $controllerName;
		$action = $actionName;
		try {
			if(method_exists($controller, $action))
			{
				// вызываем действие контроллера
				$controller->$action();
			}
		} catch (\Exception $e){

			echo $e->getMessage();

		}


	}
}