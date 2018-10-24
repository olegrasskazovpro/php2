<?php
header("Content-type: text/html; charset=utf8");
include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
include ROOT_DIR . 'services/Autoloader.php';
use \app\services\Autoloader;

spl_autoload_register([new Autoloader(), 'loadClass']);

$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . '\\' . ucfirst($controllerName) . 'Controller';

if(class_exists($controllerClass)){
	$controller = new $controllerClass;
	$controller->run($actionName);
}