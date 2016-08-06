<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/15/2016
 * Time: 2:46 PM
 */


use Src\Core\Controller;
use Src\Model\User;

class SiteController extends Controller
{

	public function actionIndex()
	{

		$this->view->render('main', 'index');
	}

	public function actionSignin()
	{
		$this->view->render('main', 'login');
	}

	public function actionSignUp()
	{
		$this->view->render('main', 'signup');
	}
}