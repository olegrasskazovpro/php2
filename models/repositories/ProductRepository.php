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

	public function getProductsByIds(array $ids)
	{
		$idStrign = implode(", ", $ids);
		$sql = "SELECT * FROM catalog WHERE id IN ({$idStrign})";
		return $this->find($sql);
	}

}