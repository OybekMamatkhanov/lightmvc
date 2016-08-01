<?php
require __DIR__ . '/vendor/autoload.php';



use Src\Core\Route;
use Src\Core\Config;
use Src\Core\Controller;
use Src\Core\App;



$config = __DIR__.'/src/config/database.php';

Config::setSettings('database', require_once($config));
Config::setSettings('lang', 'en');
/*
$config = __DIR__.'/src/config/database.php';

Model::loadConfig(require_once($config));
*/


$route = new Route($_SERVER['REQUEST_URI']);
App::run($route);

exit;
Route::handle();
 ?>
