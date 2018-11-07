<?php

namespace app\services;

class Session
{

	public function __construct()
	{
		session_start();
	}

	public function get($name)
	{
		return $_SESSION[$name];
	}

	public function set($name, $val)
	{
		$_SESSION[$name] = $val;
	}

	public function deleteOne($name)
	{
		unset($_SESSION[$name]);
	}

	public function deleteAll($name)
	{
		$arr = $_SESSION[$name];
		foreach ($arr as $key => $value){
			unset($_SESSION[$name][$key]);
		}
	}
}