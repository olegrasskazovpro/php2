<?php

namespace app\controllers;

use app\base\App;
use app\models\repositories\UserRepository;
use app\models\User;

class UserController extends Controller
{
	protected $defaultAction = 'user';

	public function actionUser()
	{
		$isAuth = App::call()->session->get('isAuth');

		if($isAuth == 1){
			$this->openUserPage();
		} else if ($isAuth == 0) {
			$this->openLoginPageWithError('Неверный логин/пароль');
		} else {
			$this->openLoginPage();
		}
	}

	public function actionLogout()
	{
		App::call()->auth->logOut();
	}

	public function actionRegistration()
	{
		if(App::call()->request->isPost()){
			$user = (new User());
			$user->name = App::call()->request->post('name');
			$user->login = App::call()->request->post('login');
			$user->password = App::call()->request->post('password');

			$newUser = (new UserRepository())->create($user);

			if(is_object($newUser)){
				App::call()->auth->saveUserToSession($newUser);
				App::call()->auth->setAuthInSession(1);
				App::call()->redirect->redirect('/user');
			} else {
				$this->openRegPageWithError('Не удалось зарегистрировать пользователя');
			}
		} else {
			echo $this->render('registration', []);
		}
	}

// далее идут private методы //

	private function openUserPage()
	{
		$user = App::call()->session->get('user');
		$user['orders'] = App::call()->orders->get($user['id']);
		echo $this->render('user', ['user' => $user]);
	}

	private function openLoginPage()
	{
		echo $this->render('login', []);
	}

	private function openLoginPageWithError($message)
	{
		echo $this->render('login', ['message' => $message]);
	}

	private function openRegPageWithError($message)
	{
		echo $this->render('registration', ['message' => $message]);
	}
}