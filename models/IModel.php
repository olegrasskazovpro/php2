<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 17:30
 */

namespace app\models;


interface IModel
{
	public function getOne($id);
	public function getAll();
	public function getTableName();
}