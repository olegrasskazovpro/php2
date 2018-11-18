<?php

namespace app\controllers;

use app\models\Images;
use app\models\repositories\Repository;

class ImagesRepository extends Repository
{
	public function getEntityClass()
	{
		return Images::class;
	}

	public function getTableName()
	{
		return 'images';
	}

	public function setMainImage($product_id)
	{
		$sql = "SELECT * FROM images WHERE product_id = :id";
		$productImages = $this->find($sql, [':id' => $product_id]);
		if(isset($productImages)){
			return 1;
		} else {
			return null;
		}
	}
}