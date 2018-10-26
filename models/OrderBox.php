<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 18:33
 */

namespace app\models;


class OrderBox extends DataEntity
{
	public $order_id;
	public $product;
	public $qty;

	public function getTableName()
	{
		return 'order_box';
	}
}