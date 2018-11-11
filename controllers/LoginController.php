<?php

class LoginController extends Controller {

	public function execute() {

		// Si 'username' et 'password' sont corrects, la variable de session 'username' est créée.
		if(isset($_POST['username']) && $_POST['username'] == 'j.forteroche' && isset($_POST['password']) && $_POST['password'] == 'admin') {
			$_SESSION['username'] = $_POST['username'];
			// Redirection vers la page d'accueil.
			header('Location: index.php?p=admin');
		}

		$viewLogin = new ViewLogin();
		$viewLogin->display();

	}

}