<?php

if (isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

switch ($p) {
	case "home":
		$pageTitle .= ' - Bienvenue';
		$controller = new FrontController();
		$content = $controller->executeHome();
		break;
	case "single":
		$controller = new FrontController();
        $content = $controller->executeSingleChapter();
        $commentController = new FrontController();
        $content2 = $commentController->executeCommentChapter();
        $signalController = new FrontController();
        $content3 = $signalController->executeSignalComment();
		break;
	case "admin":
		if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'j.forteroche') {
			header('Location: index.php?p=login');
		} else {
			$pageTitle .= ' - Tableau de bord';
			$panelController = new AdminController();
			$content = $panelController->executeAdminPanel();
			$addEditController = new AdminController();
			$content2 = $addEditController->executeAddEditChapter();
		}
		break;
	case "login":
		$pageTitle .= ' - Connexion';
		$controller = new AuthentificationController();
		$content = $controller->executeLogin();
		break;
	case "logout":
        $controller = new AuthentificationController();
        $content = $controller->executeLogout();
		break;
	default:
		$controller = new ErrorController();
		$content = $controller->executeError();
}