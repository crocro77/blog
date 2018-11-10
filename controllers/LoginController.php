<?php

class LoginController extends Controller {

	public function execute() {

		// Si 'username' et 'password' sont corrects, la variable de session 'username' est créée.
		if(isset($_POST['username']) AND $_POST['username'] == 'j.forteroche' AND isset($_POST['password']) AND $_POST['password'] == 'admin') {
			$_SESSION['username'] = $_POST['username'];
			// Redirection vers la page d'accueil.
			header('Location: index.php?p=admin');
		}

		$viewLogin = new ViewLogin();
		$viewLogin->display();

	}

}