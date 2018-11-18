<?php

namespace app\models;

use app\base\App;
use app\models\repositories\UserRepository;

class Auth
{
	private $session;

	public function __construct()
	{
		$this->session = App::call()->session;
	}

	private function confirmPassword($hash, $password)
	{
		return crypt($password, $hash) === $hash;
	}

	private function checkUserPass($user, $password)
	{
		if ($this->confirmPassword($user->password, $password)) {
			$this->setAuthInSession(1);
			return true;
		} else {
			return false;
		}
	}

	public function setAuthInSession($value)
	{
		App::call()->session->set('isAuth', $value);
	}

	public function logOut()
	{
		$this->setAuthInSession(-1);
		$this->session->set('user', null);
		App::call()->redirect->redirect('/user');
	}

	public function logIn($login, $password)
	{
		$this->setAuthInSession(-1);

		try {
			$user = (new UserRepository())->getUserByLogin($login);
		} catch (\Exception $e) {
			return 'User not found in DB';
		} finally {
			$this->setAuthInSession(0);
		}

		$isAuthSucceed = $this->checkUserPass($user, $password);
		if ($isAuthSucceed){
			return $user;
		};
	}

	public function saveUserToSession(DataEntity $user)
	{
		$userData = [];
		foreach ($user as $key => $value){
			$userData[$key] = $value;
		}

		App::call()->session->set('user', $userData);
	}
}