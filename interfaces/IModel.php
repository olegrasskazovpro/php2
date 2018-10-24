<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 17:30
 */

namespace app\interfaces;


interface IModel
{
	public static function getOne($id);
	public static function getAll();
	public static function getTableName();
}