<?php
require __DIR__ . '/vendor/autoload.php';


use Src\Core\Route;
use Src\Core\Model;
$config = __DIR__.'/src/config/database.php';

Model::loadConfig(require_once($config));

Route::handle();
 ?>
