<?php

require_once('includes/template-loader.php');

class AuthentificationController
{
    // public function executeLogin()
	// {
	// 	// Si 'username' et 'password' sont corrects, la variable de session 'username' est créée.
	// 	if (isset($_POST['username']) && $_POST['username'] == 'j.forteroche' && isset($_POST['password']) && $_POST['password'] == 'admin') {
	// 		$_SESSION['username'] = $_POST['username'];
	// 		// Redirection vers la page d'accueil admin : dashboard par défaut.
	// 		header('Location: index.php?p=admin');
	// 	}

	// 	return load_template('admin/login.php', array());
	// }

	public function executeLoginTest()
	{
		if(isset($_POST['submit'])){
			$username = htmlspecialchars(trim($_POST['username']));
			$password = htmlspecialchars(trim($_POST['password']));

			$errors = [];

			if(empty($username) || empty($password)){
				$errors['empty'] = "Tous les champs n'ont pas été remplis!";
			} elseif (isAdmin($username,$password) == 0){
				$errors['exist']  = "Cet administrateur n'existe pas!";
			}

			if(!empty($errors)){
				?>
				<div class="card red">
					<div class="card-content white-text">
						<?php
							foreach($errors as $error){
								echo $error."<br/>";
							}
						?>
					</div>
				</div>
				<?php
			} else {
				$_SESSION['username'] = $username;
				header("Location:index.php?p=admin");
			}
		}

		return load_template('admin/login.php', array());
	}

	public function executeLogout()
	{
		session_destroy();
		header('Location: index.php');
    }
}