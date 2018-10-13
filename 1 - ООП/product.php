<?php

//class Product
//{
//	public $id;
//	public $title;
//	public $description;
//	public $price;
//	public $img;
//	public $table;
//
//	public function __construct($table = null, $id = null, $title = null, $description = null, $price = null, $img = null)
//	{
//		$this->table = $table;
//		$this->id = $id;
//		$this->title = $title;
//		$this->description = $description;
//		$this->price = $price;
//		$this->img = $img;
//	}
//
//	public function addProduct($table, $title, $desc, $price, $imgName)
//	{
//		$sql = "INSERT INTO {$table} (title, `desc`, price) VALUES ('{$title}', '{$desc}', '{$price}')";
//		execute($sql);
//		$newProductId = getInsertedId();
//		$sql = "INSERT INTO images (product_id, img, main) VALUES ('{$newProductId}', '{$imgName}', '1')";
//		execute($sql);
//	}
//
//	public function deleteProduct($table, $id)
//	{
//		execute("DELETE FROM {$table} WHERE id = '{$id}'");
//	}
//
//	public function changeProduct($table, $product_id, $param, $value)
//	{
//		$sql = "UPDATE {$table} SET $param = '{$value}' WHERE id = '{$product_id}')";
//		execute($sql);
//	}
//}
//
//class SaleProduct extends Product
//{
//	public $discount;
//	public $lifetime;
//
//	public function __construct($table = null, $id = null, $title = null, $description = null, $price = null, $img = null, $discount = null, $lifetime = null)
//	{
//		parent::__construct($table, $id, $title, $description, $price, $img);
//		$this->discount = $discount;
//		$this->lifetime = $lifetime;
//	}
//
//	public function addProduct($table, $title, $description, $price, $img, $discount, $lifetime)
//	{
//		$sql = "INSERT INTO {$table} (title, `desc`, price, discount, lifetime) VALUES ('{$title}', '{$description}', '{$price}', '{$discount}', '{$lifetime}')";
//		execute($sql);
//		$newProductId = getInsertedId();
//		$sql = "INSERT INTO images (product_id, img, main) VALUES ('{$newProductId}', '{$img}', '1')";
//		execute($sql);
//	}
//}
//
//$prod = new Product('catalog', 1, 'Кроссовки', 'Новые кроссовки. Классика', 39.9, 'adidas.jpg');
//var_dump($prod);
//
//$sale = new SaleProduct('sale_catalog',2, 'Кроссовки Nike', 'Кроссовки со скидкой', 29.9, 'nike.jpg', 20, 14);
//var_dump($sale);