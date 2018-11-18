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

	/**
	 * @param string $path like 'key1.key2.key3' with '.' like delimiter
	 * @param $val - value is needed to set for the last key in a row $path
	 * @return bool - if count of levels more than 4 - method returns false
	 */
	public function set(string $path, $val)
	{
		$arr = explode('.', $path);

		if(count($arr) == 1){
			$_SESSION[$arr[0]] = $val;
		} elseif (count($arr) == 2){
			$_SESSION[$arr[0]][$arr[1]] = $val;
		} elseif (count($arr) == 3){
			$_SESSION[$arr[0]][$arr[1]][$arr[2]] = $val;
		} elseif (count($arr) == 4){
			$_SESSION[$arr[0]][$arr[1]][$arr[2]][$arr[3]] = $val;
		} else {
			return false;
		}
	}

	public function deleteOne(string $path)
	{
		$arr = explode('.', $path);

		if(count($arr) == 1){
			unset($_SESSION[$arr[0]]);
		} elseif (count($arr) == 2){
			unset($_SESSION[$arr[0]][$arr[1]]);
		} elseif (count($arr) == 3){
			unset($_SESSION[$arr[0]][$arr[1]][$arr[2]]);
		} elseif (count($arr) == 4){
			unset($_SESSION[$arr[0]][$arr[1]][$arr[2]][$arr[3]]);
		} else {
			return false;
		}
	}
}