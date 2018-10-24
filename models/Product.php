<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 13:16
 */

namespace app\models;

class Product extends DataModel
{
	public $id;
	public $title;
	public $desc;
	public $price;
	public $producerId;

	public static function getTableName()
	{
		return 'catalog';
	}

}