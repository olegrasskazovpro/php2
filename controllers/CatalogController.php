<?php

namespace app\controllers;

use app\base\App;
use app\models\repositories\ProductRepository;

class CatalogController extends Controller
{

	public function actionIndex()
	{
		echo "catalog";
	}


	public function actionCard()
	{
		$id = App::call()->request->get('id');

		$model = (new ProductRepository())->getOne($id);

		if($model){
			echo $this->render('card', ['model' => $model]);
		} else {
			echo $this->render('cardnotfound', []);
		}
	}


	public function actionCatalog()
	{
		$model = (new ProductRepository())->getAll();
		echo $this->render('catalog', ['model' => $model]);
	}
}