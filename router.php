<?php

if (isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

switch ($p) {
	case "home":
		$pageTitle .= ' - Bienvenue';
		$controller = new BlogController();
		$content = $controller->executeHome();
		break;
	case "single":
		$controller = new BlogController();
		$content = $controller->executeSingle();
		break;
	case "admin":
		if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'j.forteroche') {
			header('Location: index.php?p=login');
		} else {
			$pageTitle .= ' - Tableau de bord';
			$controller = new AdminController();
			$content = $controller->executeAdminPanel();
		}
		break;
	case "login":
		if(isset($_SESSION['username']) AND $_SESSION['username'] == 'j.forteroche') {
			header('Location: index.php');
		} else {
			$pageTitle .= ' - Connexion';
			$controller = new AdminController();
			$content = $controller->executeLogin();
		}
		break;
	case "logout":
        $controller = new AdminController();
        $content = $controller->executeLogout();
		break;
	default:
		$controller = new ErrorController();
		$content = $controller->executeError();
}