<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 18:30
 */

namespace app\models;


abstract class Cart extends DataModel
{
	public $user_id;
	public $product_id;
	public $quantity;

	public static function getTableName()
	{
		return 'cart';
	}

	public function deleteFromCart($id)
	{
		unset($_SESSION['cart'][$id]);
	}

	public function cleanCart()
	{
		unset($_SESSION['cart']);
		redirect('cart.php');
	}

	public function getCartProducts(array $cart) : array {
		return [];
	}

	public function addToCart($id, $qty)
	{
		if (!isset($_SESSION['cart'][$id])) {
			$_SESSION['cart'][$id] = $qty;
		} else {
			$_SESSION['cart'][$id] += $qty;
		}
	}
}