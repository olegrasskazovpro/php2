<?php
return [
	'rootDir' => __DIR__ . '/../',
	'templateDir' => __DIR__ . '/../views/',
	'defaultController' => 'product',
	'controllerNamespace' => 'app\\controllers',
	'components' => [
		'db' => [
			'class' => \app\services\Db::class,
			'driver' => 'mysql',
			'host' => 'localhost',
			'login' => 'root',
			'password' => 'root',
			'database' => 'shop',
			'charset' => 'utf8mb4'
		],
		'request' => [
			'class' => \app\services\Request::class,
		],
		'renderer' => [
			\app\services\renderers\TemplateRender::class,
		],
		'session' => [
			'class' => \app\services\Session::class,
		],
		'redirect' => [
			'class' => \app\services\Redirect::class,
		],
		'cart' => [
			'class' => \app\models\Cart::class,
		],
		'auth' => [
			'class' => \app\models\Auth::class,
		],
		'orders' => [
			'class' => \app\services\Orders::class,
		],
		'files' => [
			'class' => \app\services\Files::class,
			'imgDir' => __DIR__ . '/../public/img/',
		],
	]
];