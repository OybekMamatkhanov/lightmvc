<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/1/2016
 * Time: 3:22 PM
 */

namespace Src\Core\Contracts;

interface RouterInterface {
	public function getParams();
	public function getAction();
	public function getController();
	public function getUri();
	public function getLanguage();

}