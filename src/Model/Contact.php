<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/7/2016
 * Time: 3:22 AM
 */

namespace Src\Model;

use Src\Core\Model;

class Contact extends Model
{
	public $name;
	public $email;
	public $message;
	public $image;
	public $status;
	public $is_publish;

	public $error;

	public function validate($dataErr = array())
	{
		$name = htmlspecialchars(stripslashes(trim($dataErr['name'])));
		$message = htmlspecialchars(stripslashes(trim($dataErr['message'])));
		$email = filter_var($dataErr['email'], FILTER_VALIDATE_EMAIL);

		if ($name == '') {
			$this->error = 'Invalid name';
		} elseif ($message == '') {
			$this->error = 'Invalid message';
		} elseif ($email == false) {
			$this->error = 'Invalid email';
		} else {
			$this->error = 'Success';
		}



		if ( !empty($this->error) && $this->error != 'Success' ) {
			return false;
		}
		return true;
	}

	public function save($data = array())
	{

		$status = 0;
		$is_publish = 0;

		$sql = "INSERT INTO
					messages(username, email, message, status, is_publish, image)
					VALUES
						(:username, :email, :message, :status, :is_publish, :image)";

		$handler = $this->db->prepare($sql);

		$handler->bindValue(':username', $data['name'], \PDO::PARAM_STR);
		$handler->bindValue(':email', $data['email'], \PDO::PARAM_STR);
		$handler->bindValue(':message', $data['message'], \PDO::PARAM_STR);
		$handler->bindValue(':image', $this->image, \PDO::PARAM_STR);
		$handler->bindValue(':status', $status, \PDO::PARAM_INT);
		$handler->bindValue(':is_publish', $is_publish, \PDO::PARAM_INT);

		$handler->execute();

	}

	public function update($data = array())
	{
		$is_publish = 0;
		$status = 0;
		$id = (int)$data['id'];

		if ( $data['id'] ) {
			if ( !isset($data['is_published']) ) {
				$is_publish = 1;
			}

			$tempModel = $this->getById($data['id']);

			if ( $data['message'] !== $tempModel['message'] ) {
				$status = 1;
			}

			$sql = "UPDATE messages
						SET message = :message, status = :status, is_publish = :is_publish
							WHERE
								id = :id";

			$handler = $this->db->prepare($sql);

			$handler->bindParam(':message', $data['message'], \PDO::PARAM_STR);
			$handler->bindParam(':status', $status, \PDO::PARAM_INT);
			$handler->bindParam(':is_publish', $is_publish, \PDO::PARAM_INT);
			$handler->bindParam(':id', $id, \PDO::PARAM_INT);

			$handler->execute();
		}
	}

	public function getListMessages($sort = array())
	{
		$sql = "SELECT id, username, email, message, image, created_date, status, is_publish
					FROM `messages` ";

		//var_dump($sort[0]);

		if ( empty($sort) ) {
			$sql .= ' ORDER BY created_date DESC';
		} else {

			$sql .= ' ORDER BY '.$sort[0].' ASC';
		}

		$handler = $this->db->prepare($sql);

		$handler->execute();

		$result = $handler->fetchAll(\PDO::FETCH_ASSOC);

		return $result;
	}

	public function getById($id)
	{
		$id = (int)$id;

		$sql = "SELECT id, message, status, is_publish
		            FROM messages
						WHERE id = :id";

		$handler = $this->db->prepare($sql);

		$handler->bindParam(':id', $id, \PDO::PARAM_INT);

		$handler->execute();

		$result = $handler->fetch(\PDO::FETCH_ASSOC);

		return $result;
	}
}