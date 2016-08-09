<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/15/2016
 * Time: 6:30 PM
 */
namespace Src\Core;

use Src\Core\App;

class Controller
{
	public $view;

	protected $data;
	protected $model;
	protected $params;


	public function __construct($data = array())
	{
		$this->view = new View();
		$this->model = $data;
		$this->params = App::getRouter()->getParams();
	}

	/**
	 * @return mixed
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @return mixed
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * @return mixed
	 */
	public function getParams()
	{
		return $this->params;
	}
}