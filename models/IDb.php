<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 17:39
 */

namespace app\models;


interface IDb
{
	public function queryOne(string $sql): array ;
	public function queryAll(string $sql): array ;
}