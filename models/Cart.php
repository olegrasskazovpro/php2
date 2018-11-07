<?php

namespace app\models;

use app\services\Session;
use app\services\Redirect;
use app\models\repositories\ProductRepository;

class Cart extends DataEntity
{
	public $user_id;
	public $product_id;
	public $quantity;
	private $session;

	public function __construct()
	{
		$this->session = Session::getInstance();
	}

	public function getCart()
	{
		$cart = $this->session->get('cart');
		if (!empty($cart)) {
			$productsIds = array_keys($cart);
			$products = (new ProductRepository())->getProductsByIds($productsIds);
			foreach ($products as $product) {
				$data[] = [
					'product' => $product,
					'count' => $cart[$product->id]
				];
			}
			$this->session->set('cart', $data);
		}
		return $data;
	}

	public function deleteFromCart($id)
	{
//		unset($this->session->deleteOne('cart', $id));
	}

	public function cleanCart()
	{
		$this->session->deleteAll('cart');
		new Redirect('cart.php');
	}

	public function add($productId, $qty)
	{
		$cart = $this->session->get('cart');

		if (isset($cart[$productId])) {
			$cart[$productId] += (int)$qty;
		} else {
			$cart[$productId] = (int)$qty;
		}

		$this->session->set('cart', $cart);
	}
}