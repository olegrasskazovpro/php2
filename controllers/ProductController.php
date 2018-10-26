<?php

namespace app\controllers;

use app\models\Product;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{

	public function actionIndex()
	{
		echo "catalog";
	}


	public function actionCard()
	{
		$id = $_GET['id'];

		$model = (new ProductRepository())->getOne($id);
		echo $this->render('card', ['model' => $model]);
	}


	public function actionCatalog()
	{
		$model = (new ProductRepository())->getAll();
		echo $this->render('catalog', ['model' => $model]);
	}
}