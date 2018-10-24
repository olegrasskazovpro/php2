<?php
namespace app\controllers;

use app\models\Cart;

class CartController
{
	private $action;
	private $defaultAction = 'index';
	private $layout = 'main';
	private $useLayout = true;

	public function run($action = null)
	{
		$this->action = $action ?: $this->defaultAction;
		$method = "action" . ucfirst($this->action);
		if(method_exists($this, $method)){
			$this->$method();
		} else {
			echo "404";
		}
	}

	public function actionIndex()
	{
		echo "catalog";
	}


	public function actionShow()
	{
		$cart = ['id' => 1, 'title' => 'Адидас', 'desc' => 'asdfasdfasdfasfasfqfeqwef', 'price' => '30.00'];
		echo $this->render('cart', ['cart' => $cart]);
	}

	private function render($template, $params)
	{
		if($this->useLayout){
			$content = $this->renderTemplate($template, $params);
			return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
		}
		return $this->renderTemplate($template, $params);
	}

	public function renderTemplate($template, $params = [])
	{
		ob_start();
		extract($params);
		include TEMPLATES_DIR . $template . ".php";
		return ob_get_clean();
	}

}