<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/15/2016
 * Time: 6:30 PM
 */
namespace Src\Core;

class Controller
{
	public $model;
	public $view;

	public function __construct()
	{
		$this->view = new View();
	}
}