<?php
namespace app\controllers;

use app\models\Cart;

class CartController extends Controller
{

	public function actionIndex()
	{
		echo "catalog";
	}


	public function actionShow()
	{
		$cart = ['id' => 1, 'title' => 'Адидас', 'desc' => 'asdfasdfasdfasfasfqfeqwef', 'price' => '30.00'];
		echo $this->render('cart', ['cart' => $cart]);
	}

}