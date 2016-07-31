<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/14/2016
 * Time: 6:10 PM
 */
namespace Src\Core\Contracts;

interface ModelInterface {

	public static function dbConnect();
	public static function loadConfig($config);
}