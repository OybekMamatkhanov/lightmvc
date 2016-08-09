<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/15/2016
 * Time: 2:46 PM
 */


use Src\Core\Controller;
use Src\Model\User;
use Src\Model\Contact;
use Src\Core\App;
use Src\Core\Route;

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

	public function actionAdmin()
	{
		$contactModel = new Contact();

		$data = $contactModel->getListMessages();

		$this->view->render('main', 'admin', $data);
	}

	public function actionEdit()
	{
		$contactModel = new Contact();

		if ( isset($_POST) && $_POST ) {

			$contactModel->update($_POST);

			Route::redirect('/site/admin');


		}

		$id = App::getRouter()->getParams();

		$data = $contactModel->getById($id[0]);

		$this->view->render('main', 'edit', $data);
	}
}