<?php

try {
	if (isset($_GET['action'])) {
		switch ($_GET['action']) {
			// fonctionne
			case "postcomment": 
				$commentController = new FrontController();
				$content = $commentController->executeCommentChapter();
				break;
			// fonctionne
			case "signalcomment":
				$signalController = new FrontController();
				$content = $signalController->executeSignalComment($_GET['commentId']);
				break;
			// fonctionne pas
			case "createchapter":
				$createController = new AdminController();
				$content = $createController->executeCreateChapter();
				break;
			// fonctionne
			case "validateComment":
				$validateComment = new AdminController();
				$content = $validateComment->executeValidateComment();
				break;
			// fonctionne
			case "deleteComment":
				$deleteComment = new AdminController();
				$content = $deleteComment->executeDeleteComment();
				break;
			// fonctionne
			case "seenComment":
				$seenComment = new AdminController();
				$content = $seenComment->executeSeenComment();
				break;
			// fonctionne pas
			case "edit":
				$updateChapter = new AdminController();
				$content = $updateChapter->executeUpdateChapter();
				break;
			// fonctionne
			case "deletechapter":
				$deleteChapter = new AdminController();
				$content = $deleteChapter->executeDeleteChapter();
				break;
		exit();
		}
	}


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
		case "admin":
			if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'j.forteroche') {
				header('Location: index.php?p=login');
			} else {
				$pageTitle .= ' - Tableau de bord';
				$panelController = new AdminController();
				$content = $panelController->executeAdminPanel();
				break;
			}
		case "editchapter":
			$updateChapter = new AdminController();
			$content = $updateChapter->executeUpdateChapter();
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
} catch(Exception $e) {
	die("ERREUR: ".$e->getMessage());
}