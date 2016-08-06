<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/15/2016
 * Time: 3:03 PM
 */
use Src\Model\User;
use Src\Core\Controller;
use Src\Core\Upload;
use Src\Core\Route;
use Src\Core\Config;
use Src\Core\Session;

class UserController extends Controller
{
	public function actionIndex()
	{

		$this->view->render('main', 'index');
	}

	public function actionLogin()
	{
		var_dump($_POST);

		if ( $_POST && isset($_POST['email']) && isset($_POST['password']) ) {

			$user = new User();

			$this->model = $user->getUser($_POST);
			var_dump($this->model);exit;
			$password = md5($_POST['password'].Config::getSettings('salt'));

			Session::set('username', $this->model['email']);

			Route::redirect('/user/profile');
		}
	}

	public function actionRegister()
	{
		//var_dump($_FILES);
		//var_dump($_REQUEST);

		$modelUser = new User();

		$extensions = array('jpg', 'jpeg', 'png', 'bmp');

		if ( $_FILES['file']['tmp_name'] ) {

			$upload = new Upload();
			$upload->setFileName($_FILES['file']['name']);
			$upload->setTmpName($_FILES['file']['tmp_name']);
			$upload->setUploadDirectory("/home/vagrant/Code/TestTask/assets/uploads");
			$upload->setValidExtension($extensions);
			$upload->uploadFile();



			$modelUser->image = $upload->getUploadDirectory().$upload->getFileName();



		}
		$modelUser->save($_POST);


		exit;
	}

	public function actionLogout()
	{
		Session::destroy();

		Route::redirect('/site/signin');
	}

	public function actionProfile()
	{
		var_dump($this->model);exit;
		$this->view->render('main', 'profile');
	}
}