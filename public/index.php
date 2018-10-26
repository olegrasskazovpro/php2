<?php
header("Content-type: text/html; charset=utf8");
include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
require_once ROOT_DIR . 'vendor/autoload.php';

$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . '\\' . ucfirst($controllerName) . 'Controller';

if(class_exists($controllerClass)){
	$controller = new $controllerClass(new \app\services\renderers\TemplateRender());
	$controller->run($actionName);
} else {
	echo "404";
}