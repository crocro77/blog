<?php
session_start();

/**
 * Autoloader permettant de charger les différentes classes.
 * @param string $classname Le nom de la classe à charger
 */
function autoload($classname) {
	if(file_exists($file = 'controllers/' . $classname . '.php')) {
		require $file;
	} elseif(file_exists($file = 'models/' . $classname . '.php')) {
		require $file;
	} elseif(file_exists($file = 'views/' . $classname . '.php')) {
		require $file;
	} elseif(file_exists($file = 'includes/' . $classname . '.php')) {
		require $file;	
	}
}

spl_autoload_register('autoload');

$pageTitle = "Billet simple pour l'Alaska de Jean Forteroche";

if(isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

if($p === 'home') {
	$pageTitle .= ' - Bienvenue';
	$controller = new BlogController();
    $content = $controller->executeHome();
} elseif($p === 'single') {
	$controller = new BlogController();
    $content = $controller->executeSingle();
} elseif($p === 'admin') {
	if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'j.forteroche') {
		header('Location: index.php?p=login');
	} else {
		$pageTitle .= ' - Tableau de bord';
		$controller = new AdminController();
		$content = $controller->executeAdminPanel();
	}
} elseif($p === 'login') {
	if(isset($_SESSION['username']) AND $_SESSION['username'] == 'j.forteroche') {
		header('Location: index.php');
	} else {
		$pageTitle .= ' - Connexion';
		$controller = new AdminController();
		$content = $controller->executeLogin();
	}
} elseif($p === 'logout') {
	session_start();
	session_destroy();
	header('Location: index.php');
	exit();
} else {
	$controller = new ErrorController();
	$content = $controller->execute();
}

// switch ($p) {
// 	case "home":
// 		$pageTitle .= ' - Bienvenue';
// 		$controller = new BlogController();
// 		$content = $controller->executeHome();
// 	case "single":
// 		$controller = new BlogController();
// 		$content = $controller->executeSingle();
// 	case "admin":
// 		if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'j.forteroche') {
// 			header('Location: index.php?p=login');
// 		} else {
// 			$pageTitle .= ' - Tableau de bord';
// 			$controller = new AdminController();
// 			$content = $controller->executeAdminPanel();
// 		}
// 	case "login":
// 		if(isset($_SESSION['username']) AND $_SESSION['username'] == 'j.forteroche') {
// 			header('Location: index.php');
// 		} else {
// 			$pageTitle .= ' - Connexion';
// 			$controller = new AdminController();
// 			$content = $controller->executeLogin();
// 		}
// 	case "logout":
// 		session_start();
// 		session_destroy();
// 		header('Location: index.php');
// 		exit();
// 	default:
// 		$controller = new ErrorController();
// 		$content = $controller->execute();
// }

require 'views/template/default.php';