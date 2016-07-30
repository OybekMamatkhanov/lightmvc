<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/13/2016
 * Time: 5:36 PM
 */
namespace config;

return array(
	'database' => array(
		'connectionString'=>'mysql:host=localhost;dbname=db_test',//строка подклюбчения к базе данных
		'username'=>'homestead',//имя пользователя БД
		'password'=>'secret',//пароль к БД
		'charset'=>'utf8',//кодировка БД
		'userTable'=>'users',//Таблица где хранятся данные пользователя
	),
);