<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/1/2016
 * Time: 5:08 PM
 */
namespace Src\Core;

class Language
{
	protected static $data;

	public static function load($languageCode)
	{
		$languagePath = '/home/vagrant/Code/TestTask/src/lang/' . $languageCode . '.php';

		try {
			if ( file_exists($languagePath) ) {
				self::$data = include($languagePath);
			}
		} catch ( \Exception $e ) {
			$e->getMessage();
		}

	}

	public static function get($key, $value = '')
	{
		return isset(self::$data[$key]) ? self::$data[$key] : $value;
	}
}