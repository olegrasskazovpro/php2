<?php

namespace app\services\renderers;


class TemplateRender implements IRenderer
{
	public function render($template, $params = [])
	{
		ob_start();
		extract($params);
		include TEMPLATES_DIR . $template . ".php";
		return ob_get_clean();
	}
}