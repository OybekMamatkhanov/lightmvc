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

	protected $db;


	public function __construct()
	{
		//TODO
		$this->db = App::$db;
	}

	public function save()
	{
		//TODO
	}

	public function getLastId()
	{
		//TODO
	}

	protected function update()
	{
		//TODO
	}

	protected function create()
	{
		//TODO
	}

}