<?php

namespace app\models;


class OrderBox extends DataEntity
{
	public $id = null;
	public $order_id;
	public $product;
	public $qty;
	public $subtotal;

	public function getTableName()
	{
		return 'order_box';
	}
}