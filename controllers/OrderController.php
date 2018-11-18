<?php

namespace app\controllers;

use app\base\App;
use app\models\UserOrder;
use app\models\OrderBox;
use app\models\repositories\OrderBoxRepository;
use app\models\repositories\UserOrdersRepository;

class OrderController extends Controller
{
	protected $defaultAction = 'save';

	public function actionSave()
	{
		$isAuth = App::call()->session->get('isAuth');

		if ($isAuth == 1) {
			$order = $this->getOrderData();
			// сохраняем заказ за пользователем
			$orderEntity = $this->getUserOrderEntity($order);

			$newOrder = (new UserOrdersRepository())->create($orderEntity);
			$orderId = $newOrder->id;

			// записываем продукты заказа в таблицу OrderBox
			foreach ($order['cart']['products'] as $product) {
				$orderBoxItem = $this->getOrderBoxEntity($product, $orderId);
				(new OrderBoxRepository())->create($orderBoxItem);
			}
			App::call()->cart->cleanCart();
		}
		App::call()->redirect->redirect('/user');
	}

	public function actionCancel()
	{
		$isAuth = App::call()->session->get('isAuth');

		if ($isAuth == 1) {
			$id = App::call()->request->post('cancel_order_id');

			$user_order_repo = (new UserOrdersRepository());
			$user_order = $user_order_repo->getOne($id);
			$user_order->status = 'canceled';
			$user_order_repo->save($user_order);
		}
		App::call()->redirect->redirect('/user');
	}

	private function getOrderData()
	{
		return [
			'cart' => App::call()->session->get('cart'),
			'address' => App::call()->request->post('address'),
			'user_id' => App::call()->session->get('user')['id'],
		];
	}

	private function getUserOrderEntity($order)
	{
		$newOrder = (new UserOrder());
		$newOrder->id = null;
		$newOrder->user_id = $order['user_id'];
		$newOrder->total = $order['cart']['total'];
		$newOrder->address = $order['address'];
		$newOrder->status = 'new';
		return $newOrder;
	}

	private function getOrderBoxEntity($product, $orderId)
	{
		$newOrderBox = (new OrderBox());
		$newOrderBox->order_id = $orderId;
		$newOrderBox->product = (int)$product['product']->id;
		$newOrderBox->qty = $product['count'];
		$newOrderBox->subtotal = $product['subtotal'];

		return $newOrderBox;
	}
}