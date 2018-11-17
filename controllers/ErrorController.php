<?php

require('includes/template-loader.php');

class ErrorController
{
	public function execute() {
		return load_template('error.php', array());
	}
}