<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 15:53
 */

namespace app\services;
use app\models\IDb;
use http\QueryString;

class Db implements IDb
{

	public function execute(string $sql) : QueryString {
		return '\http\QueryString';
	}

	public function queryOne(string $sql) : array
	{
		return [];
	}

	public function queryAll(string $sql) : array
	{
		return [];
	}
}