<?php

namespace app\models\repositories;


use app\models\DataEntity;
use app\models\UserOrder;

class UserOrdersRepository extends Repository
{
	public function getEntityClass()
	{
		return UserOrder::class;
	}

	public function getTableName()
	{
		return 'user_orders';
	}

	public function create(DataEntity $order)
	{
		try {
			$this->insert($order);
			return $order;
		} catch (\Exception $e) {
			return "Не удалось сохранить заказ";
		}
	}

	public function getOrdersByUserId($id)
	{
		$sql = "SELECT `id`, `total`, `status` FROM user_orders WHERE user_id = :id";
		return $this->find($sql, [':id' => $id]);
	}
}