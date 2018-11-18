<?php

namespace app\controllers;

use app\base\App;

class AuthController extends Controller
{
	protected $defaultAction = 'auth';

	/**
	 * Auth user and redirect back to referer page
	 */
	public function actionAuth()
	{
		$login = App::call()->request->post('login');
		$password = App::call()->request->post('password');
		$user = App::call()->auth->logIn($login, $password);
		if($user){
			App::call()->auth->saveUserToSession($user);
		}
		$referer = App::call()->request->getReferer();
		App::call()->redirect->redirect($referer);
	}
}