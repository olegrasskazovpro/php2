<?php

namespace app\models;

use app\base\App;
use app\models\repositories\ProductRepository;

class Cart
{
	private $session;

	public function __construct()
	{
		$this->session = App::call()->session;
	}

	public function getCart()
	{
		$cart = $this->session->get('cart');
		$products = $cart['products'];

		if (is_array($products)) {
			$cart['total'] = 0;
			foreach ($products as $key => $value) {
				$product = $products[$key];
				$product['product'] = (new ProductRepository())->getOne($key);
				$subtotal = (float)$product['product']->price * $product['count'];
				$product['subtotal'] = $subtotal;

				$products[$key] = $product;
				$cart['total'] += $subtotal;
			}

			$cart['products'] = $products;
			$this->session->set('cart', $cart);
		}
		var_dump($_SESSION);

		return $cart;
	}

	public function deleteFromCart($id)
	{
		$this->session->deleteOne("cart.products.{$id}");
	}

	public function cleanCart()
	{
		$this->session->set('cart', null);
	}

	public function add($productId, $qty)
	{
		$cart = $this->session->get('cart');

		if (isset($cart['products'][$productId])) {
			$cart['products'][$productId]['count'] += (int)$qty;
		} else {
			$cart['products'][$productId]['count'] = (int)$qty;
		}

		$this->session->set('cart', $cart);
	}
}