<?php
header("Content-type: text/html; charset=utf8mb4");
$config = include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

\app\base\App::call()->run($config);