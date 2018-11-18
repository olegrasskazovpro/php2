<?php

namespace app\controllers;

use app\base\App;
use app\models\Images;
use app\models\Product;
use app\models\repositories\ProductRepository;

class CatalogController extends Controller
{
	protected $defaultAction = 'catalog';

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

	public function actionModify()
	{
		echo $this->render('catalogModify', []);
	}

	public function actionAdd()
	{
		$new = (new Product());
		$new->title = App::call()->request->post('title');
		$new->desc = App::call()->request->post('desc');
		$new->price = App::call()->request->post('price');
		$new->img = App::call()->request->post('img');
		$newProduct = (new ProductRepository())->save($new);

		$imgEntity = (new Images());
		$imgRepo = (new ImagesRepository());

		$imgEntity->product_id = $newProduct->id;
		$imgEntity->img = App::call()->files->load('img', 'imgDir');
		$imgEntity->main = $imgRepo->setMainImage($newProduct->id);
		$imgRepo->insert($imgEntity);

		App::call()->redirect->redirect('/catalog');
	}

	public function actionDelete()
	{
		$id = App::call()->request->post('id');
		$product_repo = (new ProductRepository());
		$product = $product_repo->getOne($id);
		$product_repo->delete($product);
		App::call()->redirect->redirect('/catalog/modify');
	}
}