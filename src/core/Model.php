<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/14/2016
 * Time: 7:07 PM
 */
namespace  Src\Core;
use Src\Core\Contracts\ModelInterface;

abstract class Model implements ModelInterface
{
	protected $tableName = '';

	protected static $config;
	protected static $db;
	public $errorCode;

	public function __construct()
	{

		$this->dbConnect();

	}

	public static function loadConfig($config)
	{
		self::$config = $config;
	}

	public static function dbConnect()
	{

		$dbOptions = array(
			\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . self::$config['database']['charset'] . '',
			\PDO::ATTR_PERSISTENT => true);

		try {
			self::$db = new \PDO(
				self::$config['database']['connectionString'],
				self::$config['database']['username'],
				self::$config['database']['password'],
				$dbOptions
			);
		}
		catch(\PDOException $e) {
			echo $e->getMessage();
		}

		return self::$db;
	}

}