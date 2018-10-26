<?php
namespace app\services\renderers;
require_once ROOT_DIR . 'vendor/autoload.php';
require_once ROOT_DIR . 'vendor/twig/twig/lib/Twig/Autoloader.php';

class TwigRenderers implements IRenderer
{
	private $templater;

	public function __construct()
	{
		$loader = new \Twig_Loader_Filesystem(ROOT_DIR . 'views/twig');
		$this->templater = new \Twig_Environment($loader);
	}


	public function render($template, $params = [])
	{
		$template .= ".twig";
		return $this->templater->render($template, $params);
	}
}