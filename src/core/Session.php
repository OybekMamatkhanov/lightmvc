<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/2/2016
 * Time: 3:43 AM
 */

namespace Src\Core;


class Session
{
	protected static $flash;

	/**
	 * @param mixed $message
	 */
	public static function setFlash($message)
	{
		self::$flash = $message;
	}

	public static function hasFlash()
	{
		return ( !is_null(self::$flash) );
	}

	public static function flash()
	{
		echo self::$flash;
		self::$flash = null;
	}

	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public static function get($key)
	{
		if ( isset($_SESSION[$key]) ) {
			return $_SESSION[$key];
		}

		return null;
	}

	public static function delete($key)
	{
		if ( isset($_SESSION[$key]) ) {
			unset($_SESSION[$key]);
		}
	}

	public static function destroy()
	{
		session_destroy();
	}














}