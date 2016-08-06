<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/1/2016
 * Time: 6:05 PM
 */
namespace Src\Core;
use PDO;

class DB
{
	private $connection,
			$query,
			$result = array(),
			$count;

	private static $instance;

	public static function getConnection()
	{
		if ( !isset(self::$instance) ) {
			self::$instance = new DB();
		}
		return self::$instance;
	}

	private function __construct()
	{
		$config = Config::getSettings('database');

		try {
			$this->connection = new \PDO(
				$config['connectionString'],
				$config['username'],
				$config['password']
			);

			$this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

			return $this->connection;
		}
		catch(\PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function __clone()
	{
		return false;
	}
	public function __wakeup()
	{
		return false;
	}

	public function query($sql)
	{
		return $this->connection->query($sql);
	}

	public function prepare($sql, $options = array())
	{
		if ( $options ) $options = array();
		return $this->connection->prepare($sql, $options);
	}

	public function exec($sql)
	{
		return $this->connection->exec($sql);
	}

	public function fetchAllAssoc($sql) {
		return $this->connection->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function fetchRowAssoc($sql) {
		return $this->connection->query($sql)->fetch(\PDO::FETCH_ASSOC);
	}

	public function bindParam()
	{

	}



















}