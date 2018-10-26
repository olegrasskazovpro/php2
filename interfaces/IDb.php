<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 17:39
 */

namespace app\interfaces;


interface IDb
{
	public function queryOne(string $sql, array $params) ;
	public function queryAll(string $sql, array $params) ;
	public function execute(string $sql, array $params);
}