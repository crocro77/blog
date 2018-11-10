<?php
class ErrorController {
	public function execute() {
		$viewError = new ViewError();
		$viewError->display();
	}
}