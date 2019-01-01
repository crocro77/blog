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
        $chapterManager = new Chapter();
        $listOfChapters = $chapterManager->getList();
        $commentManager = new Comment();
        $listOfComments = $commentManager->getAllComments();
		$signaledComments = $commentManager->getSignaledComments();

		// onglet de l'espace admin
		if (isset($_GET['tab'])) {
			$selectedTab = $_GET['tab'];
		}

		return load_template('admin/admin.php', array('signaledComments' => $signaledComments, 'listOfComments' => $listOfComments, 'listOfChapters' => $listOfChapters, 'selectedTab' => $selectedTab));
	}

	public function executeCreateChapter()
    {
		if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['content'])){
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
				// Create du chapitre
				$chapter = new Chapter();
				$chapter->setTitle($_POST['title']);
				$chapter->setContent($_POST['content']);
				$chapter->setAuthor($_POST['author']);
				// upload de l'image de chapitre
				include 'includes/image-upload.php';
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
		if(isset($_GET['id'])) {
			$chapter = $chapterManager->getUnique($_GET['id']);
			// Edition du chapitre
			if($chapter) {
				if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['author'])) {
					$chapter->setTitle($_POST['title']);
					$chapter->setContent($_POST['content']);
					$chapter->setAuthor($_POST['author']);
					// upload de l'image de chapitre
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
		if(isset($_GET['commentId'])) {
			$commentManager = new Comment();
			$commentManager->validateComment($_GET['commentId']);
			header("Location:index.php?p=admin&tab=comments");
		}
	}

	public function executeDeleteComment()
	{
		// suppression d'un commentaire
		if(isset($_GET['commentId'])) {
			$commentManager = new Comment();
			$commentManager->deleteComment($_GET['commentId']);
			header("Location:index.php?p=admin&tab=comments");
		}
	}

	public function executeSeenComment()
	{
		// marqué un commentaire comme vu
		if(isset($_GET['commentId'])) {
			$commentManager = new Comment();
			$commentManager->seenComment($_GET['commentId']);
			header("Location:index.php?p=admin&tab=comments");
		}
	}
}