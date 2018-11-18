<?php

namespace app\models\repositories;

use app\models\DataEntity;
use app\models\OrderBox;

class OrderBoxRepository extends Repository
{
	public function getEntityClass()
	{
		return OrderBox::class;
	}

	public function getTableName()
	{
		return 'order_box';
	}

	public function create(DataEntity $orderBox)
	{
		try {
			$this->insert($orderBox);
			return $orderBox;
		} catch (\Exception $e) {
			return "Не удалось сохранить заказ";
		}
	}
	
	public function getProductsByOrderId($order_id)
	{
		$sql = "SELECT `product` FROM order_box WHERE order_id = :id";
		return $this->find($sql, [':id' => $order_id]);
	}
}