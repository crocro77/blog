<?php

if (isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

switch ($p) {
	case "home":
		$pageTitle .= ' - Bienvenue';
		$controller = new BlogHomeControllerTest();
		$content = $controller->executeHome();
		break;
	case "single":
		$chapterController = new BlogSingleChapterControllerTest();
		$content = $chapterController->executeSingleChapter();
		$commentController = new BlogCommentChapterControllerTest();
		$content2 = $commentController->executeCommentChapter();
		break;
	case "admin":
		if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'j.forteroche') {
			header('Location: index.php?p=login');
		} else {
			$pageTitle .= ' - Tableau de bord';
			$panelController = new AdminPanelControllerTest();
			$content = $panelController->executeAdminPanel();
			$addEditController = new AdminAddEditControllerTest();
			$content2 = $addEditController->executeAddEditChapter();
		}
		break;
	case "login":
		$pageTitle .= ' - Connexion';
		$controller = new AdminPanelControllerTest();
		$content = $controller->executeLogin();
		break;
	case "logout":
        $controller = new AdminPanelControllerTest();
        $content = $controller->executeLogout();
		break;
	default:
		$controller = new ErrorController();
		$content = $controller->executeError();
}