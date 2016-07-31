<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/1/2016
 * Time: 7:31 PM
 */
namespace Src\Core;

class View
{
	public function render($template, $view, $model = null)
	{
		include 'src/views/'. $template. '.php';
	}
}