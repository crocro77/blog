<?php

require_once('includes/template-loader.php');

class AuthentificationController
{
    public function executeLogin()
	{
		// Si 'username' et 'password' sont corrects, la variable de session 'username' est créée.
		if (isset($_POST['username']) && $_POST['username'] == 'j.forteroche' && isset($_POST['password']) && $_POST['password'] == 'admin') {
			$_SESSION['username'] = $_POST['username'];
			// Redirection vers la page d'accueil admin : dashboard par défaut.
			header('Location: index.php?p=admin');
		}

		return load_template('admin/login.php', array());
	}

	public function executeLogout()
	{
		session_destroy();
		header('Location: index.php');
    }
}