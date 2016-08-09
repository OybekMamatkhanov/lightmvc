<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/8/2016
 * Time: 12:16 AM
 */

namespace Src\Core;

class AjaxRequest
{
	public $data;
	public $code;
	public $message;
	public $status;

	private $param;
	private $response;
	private $callback;
	private $request;

	public function __construct($request)
	{
		$this->request = $request;

	}


}