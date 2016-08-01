<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/1/2016
 * Time: 3:59 AM
 */

namespace Src\Core;

class Config
{
	protected static $settings = array();

	/**
	 * @param string $key
	 * @return array
	 */
	public static function getSettings($key)
	{
		return isset( self::$settings[$key] ) ? self::$settings[$key] : null;
	}

	/**
	 * @param string $key
	 * @param mixed $value
	 */
	public static function setSettings($key, $value)
	{
		self::$settings[$key] = $value;
	}

}