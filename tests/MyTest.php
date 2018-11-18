<?php

namespace app\tests;


use app\controllers\UserController;

class UserTest extends \PHPUnit\Framework\TestCase
{
	public function testAuth()
	{
		$auth = new UserController();
		$this->assertTrue($auth->actionAuth('',''), ['message' => 'Авторизация не удалась']);
	}
}