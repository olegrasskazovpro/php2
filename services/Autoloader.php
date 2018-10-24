<?php
namespace app\services;

class Autoloader
{
	public function loadClass($className){
		$filename = str_replace(['app\\', '\\'], [ROOT_DIR, DIRECTORY_SEPARATOR], $className);
		$filename .= ".php";
		if(file_exists($filename)){
			include $filename;
		}
	}
}