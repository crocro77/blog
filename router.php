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
			case "validateComment":
				$validateComment = new AdminController();
				$content = $validateComment->executeValidateComment();
				break;
			case "deleteComment":
				$deleteComment = new AdminController();
				$content = $deleteComment->executeDeleteComment();
				break;
			case "seenComment":
				$seenComment = new AdminController();
				$content = $seenComment->executeSeenComment();
				break;
			// fonctionne pas /?\ double emploi avec lignes 44-48 /?\
			case "editchapter":
				$updateChapter = new AdminController();
				$content = $updateChapter->executeUpdateChapter();
				break;
			case "deletechapter":
				$deleteChapter = new AdminController();
				$content = $deleteChapter->executeDeleteChapter();
				break;
		}
		exit();
	}

	if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['content'])) {
		// creation du chapitre
		if (empty($_POST['id'])) {
			$createController = new AdminController();
			$content = $createController->executeCreateChapter();
		// si l'id existe déjà : update du chapitre -- fonctionne pas /?\ double emploi avec lignes 27-30
		} elseif (isset($_POST['id'])) {
			$updateChapter = new AdminController();
			$content = $updateChapter->executeUpdateChapter();
		}
	} elseif (!empty($_POST)) {
		$errors = '';
		if (empty($_POST['title'])) {
			$errors .= '<li>Le titre est obligatoire.</li>';
		}
		if (empty($_POST['author'])) {
			$errors .= '<li>L\'auteur est obligatoire.</li>';
		}
		if (empty($_POST['content'])) {
			$errors .= '<li>Le contenu est obligatoire.</li>';
		}

		$_SESSION['flash']['error'] = '<ul>' . $errors . '</ul>';
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