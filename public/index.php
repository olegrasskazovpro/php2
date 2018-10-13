<?php
header("Content-type: text/html; charset=utf-8");
include $_SERVER['DOCUMENT_ROOT'] . "/php2/services/Autoloader.php";
use \app\services\Autoloader;
use \app\models as models;

spl_autoload_register([new Autoloader(), 'loadClass']);


$product = new models\Product();
var_dump($product);