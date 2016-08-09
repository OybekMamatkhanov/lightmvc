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
use Src\Model\Contact;
use Src\Core\ImageResize;
use Src\Core\App;

class UserController extends Controller
{

	public function actionIndex()
	{
		$this->view->render('main', 'index');
	}

	public function actionLogin()
	{
		if ( $_POST && isset($_POST['email']) && isset($_POST['password']) ) {

			$user = new User();

			$this->model = $user->getUser($_POST);

			$password = md5($_POST['password'].Config::getSettings('salt'));

			if ($this->model) {
				if ( $this->model['password'] === $password ) {
					Session::set('username', $this->model['email']);
					Session::set('role', $this->model['role']);
					Route::redirect('/user/profile');
				} else {
					Session::setFlash('Incorect password');
				}
			} else {
				Session::setFlash('No such user registered');
			}

		}

		$this->view->render('main', 'login');
	}

	public function actionSignup()
	{
		$modelUser = new User();

		if ( $modelUser->getUser($_POST) )
		{
			Session::setFlash('User with such email already exist');
			$this->view->render('main', 'signup');

		} else {

			if ($_FILES['image']['tmp_name']) {

				$resizeFile = new ImageResize($_FILES);

				$resizeFile->resizeImage(320, 240);
				$resizeFile->saveImage("/home/vagrant/Code/TestTask/assets/uploads/" . $_FILES['image']['name'], 100);

				$modelUser->image = $_FILES['image']['name'];
			}

			$modelUser->save($_POST);
			Session::setFlash('Thank You, now you have to log in');
			Route::redirect('/');
		}
	}

	public function actionLogout()
	{
		Session::destroy();

		Route::redirect('/site/signin');
	}

	public function actionProfile()
	{

		$this->view->render('main', 'profile');
	}

	public function actionContact()
	{
		$modelContact = new Contact();

		if ( isset($_POST) && $_POST ) {

			if ( $modelContact->validate($_POST) ) {

				if ($_FILES['image']['tmp_name']) {

					$resizeFile = new ImageResize($_FILES);

					$resizeFile->resizeImage(320, 240);
					$resizeFile->saveImage("/home/vagrant/Code/TestTask/assets/uploads/" . $_FILES['image']['name'],
						100);

					$resizeFile->resizeImage(60, 40);
					$resizeFile->saveImage("/home/vagrant/Code/TestTask/assets/uploads/thumb/" . $_FILES['image']['name'],
						50);

					$modelContact->image = $_FILES['image']['name'];
					$modelContact->save($_POST);
				}
			}
			$data['error'] = $modelContact->error;
		}

		$sort = App::getRouter()->getParams();

		$data['dataProvider'] = $modelContact->getListMessages($sort);

		$this->view->render('main', 'contact', $data);
	}
}