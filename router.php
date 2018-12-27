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
		break;
	case "postcomment": 
        $commentController = new FrontController();
		$content = $commentController->executeCommentChapter();
		break;
	case "signalcomment":
        $signalController = new FrontController();
        $content = $signalController->executeSignalComment();
		break;
	case "admin":
		if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'j.forteroche') {
			header('Location: index.php?p=login');
		} else {
			$pageTitle .= ' - Tableau de bord';
			$panelController = new AdminController();
			$content = $panelController->executeAdminPanel();
			break;
		}
	case "createchapter":
		$writeController = new AdminController();
		$content = $writeController->executeCreateChapter();
		break;
	case "commentmanager":
		$commentAdminManager = new AdminController();
		$content = $commentAdminManager->executeCommentManager();
		break;
	case "editchapter":
		$updateChapter = new AdminController();
		$content = $updateChapter->executeUpdateChapter();
		break;
	case "deletechapter":
		$deleteChapter = new AdminController();
		$content = $deleteChapter->executeDeleteChapter();
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