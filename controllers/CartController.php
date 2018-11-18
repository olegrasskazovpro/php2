<?php
namespace app\controllers;

use app\base\App;

class CartController extends Controller
{
	protected $defaultAction = 'cart';

	public function actionCart()
	{
		$cart = App::call()->cart->getCart();
		if($cart){
			echo $this->render('cart', ['cart' => $cart]);
		} else {
			echo $this->render('emptycart', []);
		}
	}

	public function actionAdd()
	{
		$productId = App::call()->request->post('id');
		$qty = App::call()->request->post('qty') ?: 1;
		try {
			App::call()->cart->add($productId, $qty);
		} catch (\Exception $e) {
			App::call()->redirect->redirect('catalog');
		}

		$referer = App::call()->request->getReferer();
		App::call()->redirect->redirect($referer);
//		echo json_encode(['success' => 'ok', 'message' => 'Product was added to card']);

	}

	public function actionDelete()
	{
		$productId = App::call()->request->post('id');
		App::call()->cart->deleteFromCart($productId);
		App::call()->redirect->redirect('../cart');
//		echo json_encode(['success' => 'ok', 'message' => 'Товар был удален из корзины']);
	}

	public function actionClean(){
		App::call()->cart->cleanCart();
		App::call()->redirect->redirect('cart');
	}
}