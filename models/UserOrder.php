<?php

namespace app\models;


class UserOrder extends DataEntity
{
	public $id;
	public $user_id;
	public $total;
	public $address;
	public $status;

	public function getTableName()
	{
		return 'user_orders';
	}
}