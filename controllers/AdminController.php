<?php

require_once('includes/template-loader.php');

class AdminController
{
	public function __construct()
	{
		if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'j.forteroche') {
			header('Location: index.php?p=login');
			exit();
		}
	}

	public function executeAdminPanel()
	{
		$selectedTab = 'dashboard';
        $chapter = null;
        $chapterManager = new Chapter();
        $listOfChapters = $chapterManager->getList();
        $commentManager = new Comment();
        $listOfComments = $commentManager->getAllComments();
		$signaledComments = $commentManager->getSignaledComments();

		// onglet de l'espace admin
		if (isset($_GET['tab'])) {
			$selectedTab = $_GET['tab'];
		}

		return load_template('admin/admin.php', array('signaledComments' => $signaledComments, 'listOfComments' => $listOfComments, 'listOfChapters' => $listOfChapters, 'selectedTab' => $selectedTab, 'chapter' => $chapter));
	}

	public function executeCreateChapter()
    {
		if(isset($_POST['title'])){
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
			if (empty($errors)) {
				// upload de l'image de chapitre
				include 'includes/image-upload.php';

				// Create du chapitre
				$chapter = new Chapter();
				$chapter->setTitle($_POST['title']);
				$chapter->setContent($_POST['content']);
				$chapter->setAuthor($_POST['author']);
				$chapter->setChapterImage($chapter_image);
				$chapter->add($chapter);
				header("Location:index.php?p=admin&tab=list");
			} else {
				$_SESSION['flash']['error'] = '<ul>' . $errors . '</ul>';
			}
		}
		return load_template('admin/admin.php', array('selectedTab' => 'write'));
	}

	public function executeUpdateChapter()
	{
		$chapterManager = new Chapter();
		$chapter = $chapterManager->getUnique($_GET['id']);
		if($chapter) {
			if(isset($_POST['title'])) {
				$chapter->setTitle($_POST['title']);
				$chapter->setContent($_POST['content']);
				$chapter->setAuthor($_POST['author']);
				include 'includes/image-upload.php';
				if(!empty($chapter_image)) {
					$chapter->setChapterImage($chapter_image);
				}
				$chapter->updateChapter();
				header("Location:index.php?p=admin&tab=list");
			}
			$selectedTab = 'write';
			$action = 'edit';
			return load_template('admin/admin.php', array('selectedTab' => $selectedTab, 'chapter' => $chapter, 'action' => $action));
		} else {
			header("Location:index.php?p=admin&tab=list");
		}
	}

	public function executeDeleteChapter()
	{
		// suppression d'un chapitre
		$chapterManager = new Chapter();
		$chapterManager->deleteChapter();
		header("Location:index.php?p=admin&tab=list");
	}

	public function executeValidateComment()
	{
		// validation d'un commentaire signalé
		$commentManager = new Comment();
		$commentManager->validateComment($_GET['commentId']);
        header("Location:index.php?p=admin&tab=comments");
	}

	public function executeDeleteComment()
	{
		// suppression d'un commentaire
		$commentManager = new Comment();
		$commentManager->deleteComment($_GET['commentId']);
        header("Location:index.php?p=admin&tab=comments");
	}

	public function executeSeenComment()
	{
		// marqué un commentaire comme vu
		$commentManager = new Comment();
		$commentManager->seenComment($_GET['commentId']);
        header("Location:index.php?p=admin&tab=comments");
	}
}