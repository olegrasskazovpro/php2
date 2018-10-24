<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 18:32
 */

namespace app\models;


class Orders extends DataModel
{
	public $id;
	public $user_id;
	public $status;

	public function getTableName()
	{
		return 'orders';
	}
}