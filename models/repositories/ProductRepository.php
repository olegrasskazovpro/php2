<?php

namespace app\models\repositories;

use app\models\Product;

class ProductRepository extends Repository
{

	public function getEntityClass()
	{
		return Product::class;
	}

	public function getTableName()
	{
		return 'catalog';
	}

}