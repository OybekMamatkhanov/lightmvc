<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/15/2016
 * Time: 3:03 PM
 */
use Src\Model\User;
use Src\Core\Controller;

class UserController extends Controller
{
	public function actionIndex()
	{


		$user = new User();

		$model = array();

		if ( !empty($_POST['username']) ) {
			$model = $user->search($_POST['username']);
		}

		$this->view->render('main', 'index', $model);
	}
}