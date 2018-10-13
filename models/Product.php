<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 13:16
 */

namespace app\models;

class Product extends Model
{
	public $id;
	public $name;
	public $description;
	public $price;
	public $producerId;

	public function getTableName()
	{
		return 'catalog';
	}

}