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
	}
}

spl_autoload_register('autoload');

$pageTitle = "Billet simple pour l'Alaska de Jean Forteroche";

if(isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

ob_start();

if($p === 'home') {
	$pageTitle .= ' - Bienvenue';
	$controller = new HomeController();
    $controller->execute();
} elseif($p === 'single') {
	$controller = new SingleController();
    $controller->execute();
} elseif($p === 'admin') {
	if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'j.forteroche') {
		header('Location: index.php?p=login');
	} else {
		$pageTitle .= ' - Tableau de bord';
		$controller = new AdminController();
		$controller->execute();
	}
} elseif($p === 'login') {
	if(isset($_SESSION['username']) AND $_SESSION['username'] == 'j.forteroche') {
		header('Location: index.php');
	} else {
		$pageTitle .= ' - Connexion';
		$controller = new LoginController();
		$controller->execute();
	}
} elseif($p === 'logout') {
	session_start();
	session_destroy();
	header('Location: index.php');
	exit();
} else {
	$controller = new ErrorController();
	$controller->execute();
}

$content = ob_get_clean();
require 'views/template/default.php';