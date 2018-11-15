<?php

class ErrorController extends LoginController
{
	public function execute() {
		return $this->load_template('refactor_views/Error.php', array());
	}

	/**
	 * Template loader
	 * @param $template_name
	 * @param array $data
	 * @return string
	 */

	function load_template($template_name, $data = array())
	{
    	//Extract variables from the array
		extract($data);

    	//Getting template content
		ob_start();
		include 'views/' . (string)$template_name;
		$template = ob_get_contents();
		ob_end_clean();
		return $template;
	}
}