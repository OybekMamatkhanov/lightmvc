<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/14/2016
 * Time: 8:14 PM
 */
namespace Src\Model;

use Src\Core\Config;
use Src\Core\Model as Model;

class User extends Model
{
	public $tableName = 'user';
	public $username;
	public $email;
	public $password;
	public $image;


	public function getUser($data = array())
	{
		$sql = "SELECT username, email, password, image, role
					FROM `user_test`
						WHERE email = :email";

		$handler = $this->db->prepare($sql);

		$handler->bindValue(':email', $data['email'], \PDO::PARAM_STR);

		$handler->execute();

		$result = $handler->fetch(\PDO::FETCH_ASSOC);

		return $result;
	}

	public function save($data = array())
	{

		$password = md5($data['password'].Config::getSettings('salt'));
		$sql = "INSERT INTO
					user_test(`username`, `email`, `password`, `image`)
					VALUES
						(:username, :email, :password, :image)";

		$handler = $this->db->prepare($sql);

		$handler->bindValue(':username', $data['username'], \PDO::PARAM_STR);
		$handler->bindValue(':email', $data['email'], \PDO::PARAM_STR);
		$handler->bindValue(':password', $password, \PDO::PARAM_STR);
		$handler->bindValue(':image', $this->image, \PDO::PARAM_STR);

		$handler->execute();
	}

}