<?php
require __DIR__ . '/vendor/autoload.php';



use Src\Core\Route;
use Src\Core\Config;
use Src\Core\App;
use Src\Core\Session;


$config = __DIR__.'/src/config/database.php';

Config::setSettings('database', require_once($config));
Config::setSettings('lang', array('en', 'ru'));
Config::setSettings('salt', 'dfJI7nkj');
Config::setSettings('route', array( 'default' => ''));
/*
$config = __DIR__.'/src/config/database.php';

Model::loadConfig(require_once($config));
*/
session_start();

$route = new Route($_SERVER['REQUEST_URI']);
App::run($route);




exit;

