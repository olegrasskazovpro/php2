<?php
namespace app\controllers;

use app\models\Cart;
use app\services\Request;
use app\services\Session;

class CartController extends Controller
{

	public function actionIndex()
	{
		$data = (new Cart())->getCart();
		echo $this->render('cart', ['cart' => $data]);
	}

	public function actionAdd()
	{
		$request = new Request();
		$productId = $request->post('id');
		$productQty = $request->post('qty') ?: 0;
		(new Cart())->add($productId, $productQty);
		echo json_encode(['success' => 'ok', 'message' => 'Товар был добавлен в корзину']);
	}

	public function actionShow()
	{
		$cart = ['id' => 1, 'title' => 'Адидас', 'desc' => 'asdfasdfasdfasfasfqfeqwef', 'price' => '30.00'];
		echo $this->render('cart', ['cart' => $cart]);
	}
}