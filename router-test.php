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
		$controller = new BlogSingleChapterControllerTest();
		$content = $controller->executeSingleChapter();
		$controller2 = new BlogCommentChapterControllerTest();
		$content2 = $controller2->executeCommentChapter();
		break;
	case "admin":
		if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'j.forteroche') {
			header('Location: index.php?p=login');
		} else {
			$pageTitle .= ' - Tableau de bord';
			$controller = new AdminPanelControllerTest();
			$content = $controller->executeAdminPanel();
			$controller2 = new AdminAddEditControllerTest();
			$content2 = $controller2->executeAddEditChapter();
		}
		break;
	case "login":
		if(isset($_SESSION['username']) AND $_SESSION['username'] == 'j.forteroche') {
			header('Location: index.php');
		} else {
			$pageTitle .= ' - Connexion';
			$controller = new AdminPanelControllerTest();
			$content = $controller->executeLogin();
		}
		break;
	case "logout":
        $controller = new AdminPanelControllerTest();
        $content = $controller->executeLogout();
		break;
	default:
		$controller = new ErrorController();
		$content = $controller->executeError();
}