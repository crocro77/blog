<?php

try {
	if (isset($_GET['action'])) {
		switch ($_GET['action']) {
			case "postcomment": 
				$commentController = new FrontController();
				$content = $commentController->executeCommentChapter();
				break;
			case "signalcomment":
				$signalController = new FrontController();
				$content = $signalController->executeSignalComment($_GET['commentId']);
				break;
			case "validatecomment":
				$validateComment = new AdminController();
				$content = $validateComment->executeValidateComment();
				break;
			case "deletecomment":
				$deleteComment = new AdminController();
				$content = $deleteComment->executeDeleteComment();
				break;
			case "seencomment":
				$seenComment = new AdminController();
				$content = $seenComment->executeSeenComment();
				break;
			case "deletechapter":
				$deleteChapter = new AdminController();
				$content = $deleteChapter->executeDeleteChapter();
				break;
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
			// if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'j.forteroche') {
			// 	header('Location: index.php?p=login');
			// } else {
				$pageTitle .= ' - Tableau de bord';
				$panelController = new AdminController();
				$content = $panelController->executeAdminPanel();
				break;
			//}
		case "write":
			$createController = new AdminController();
			$content = $createController->executeCreateChapter();
			break;
		case "edit":
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
	echo 'test';
	die("ERREUR: ".$e->getMessage());
}