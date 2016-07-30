<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/15/2016
 * Time: 2:20 PM
 */
namespace Core;

class Route
{
	static function handle()
	{
		// контроллер и действие по умолчанию
		$controllerName = 'Main';
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
		$controllerName = 'Controller'.ucfirst($controllerName);
		$actionName = 'action'.ucfirst($actionName);

		// подцепляем файл с классом модели (файла модели может и не быть)

		$modelFile = ucfirst($modelName).'.php';
		$modelPath = "src/Models/".$modelFile;
		if(file_exists($modelPath))
		{
			include "src/Models/" . $modelFile;
		}

		// подцепляем файл с классом контроллера
		$controllerFile = strtolower($controllerName).'.php';
		$controllerPath = "src/Controllers/" . $controllerFile;
		if(file_exists($controllerPath))
		{
			include "application/controllers/".$controller_file;
		}
		else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404();
		}

		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;

		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}

	}

	function ErrorPage404()
	{
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
	}

}