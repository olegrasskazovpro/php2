<?php

namespace app\services;

use app\base\App;

class Orders
{
	public function get($user_id)
	{
		$userOrders = $this->getUserOrdersData($user_id);

		$orders = [];
		foreach ($userOrders as $key => $orderItem){
			$id = $orderItem['id'];

			if(!isset($orders[$id])){
				$orders[$id]['products'] = $orderItem['product'];
				$orders[$id]['total'] = $orderItem['total'];
				$orders[$id]['status'] = $orderItem['status'];
				$orders[$id]['button'] = $this->getCancelButton($orderItem['status'], $id);
			} else {
				$orders[$id]['products'] .= ', ' . $orderItem['product'];
			}
		}
		return $orders;
	}

	private function getCancelButton($status, $orderId)
	{
		if ($status == 'new') {
			return "<p class=\"cancel_order\"><button name=\"cancel_order_id\" value=\"{$orderId}\">Отменить</button></p>";
		} else {
			return "<p class=\"cancel_order\">-</p>";
		}
	}

	private function getUserOrdersData($user_id)
	{
		$sql = "SELECT `user_orders`.`id`,
						`catalog`.`title` AS `product`,
						`user_orders`.`total`,
						`user_orders`.`status`
						FROM `user_orders` LEFT JOIN (`order_box`) ON (`order_box`.`order_id` = `user_orders`.`id`)
						LEFT JOIN (`catalog`) ON (`order_box`.`product` = `catalog`.`id`)
						WHERE `user_id` = :id";
		return App::call()->db->queryAll($sql, [':id' => $user_id]);
	}
}