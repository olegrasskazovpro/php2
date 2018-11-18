<?php

namespace app\models\repositories;

use app\models\DataEntity;
use app\models\User;
use app\base\App;

class UserRepository extends Repository
{
	public function getEntityClass()
	{
		return User::class;
	}

	public function getTableName()
	{
		return 'users';
	}

	public function getUserByLogin($login)
	{
		$sql = "SELECT * FROM users WHERE login = :login";
		$obj = App::call()->db->queryObj($sql, [':login' => $login], $this->getEntityClass())[0];
		try {
			$this->saveObject($obj);
		} catch (\Exception $e) {
			echo "Не удалось получить пользователя из БД";
		} finally {
			return $obj;
		}
	}

	public function create(DataEntity $user)
	{
		$user->password = $this->hashPassword($user->password);

		try {
			$this->insert($user);
			return $user;
		} catch (\Exception $e) {
			return "Не удалось зарегистрировать пользователя";
		}
	}

	private function hashPassword($password) {
		$salt = md5(uniqid('some_prefix', true));
		$salt = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
		return crypt($password, '$2a$08$' . $salt);
	}
}