<?php

require_once('includes/template-loader.php');

class AdminController
{
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
		$title = $_POST['title'];
		$author = $_POST['author'];
		$content = $_POST['content'];
		$chapter_image = "";

		// upload de l'image de chapitre
		include 'includes/image-upload.php';

		// Create du chapitre
		$chapter = new Chapter();
		$chapter->setTitle($title);
		$chapter->setContent($content);
		$chapter->setAuthor($author);
		$chapter->setChapterImage($chapter_image);
		$chapter->add($chapter);
		header("Location:index.php");
	}

	public function executeUpdateChapter()
	{
		// $chapterManager = new Chapter();
		// $chapter = $chapterManager->getUnique($_GET['id']);
		// if($chapter) {
		// 	$selectedTab = 'write';
		// 	$action = 'edit';
		// 	return load_template('admin/admin.php', array('selectedTab' => $selectedTab, 'chapter' => $chapter, 'action' => $action));
		// } else {
		// 	header("Location:index.php?p=admin&tab=list");
		// }

		// maj d'un contenu dans la bdd //
		// $errors = '';
		// if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['content'])) {
			$title = $_POST['title'];
			$author = $_POST['author'];
			$content = $_POST['content'];
			$chapter_image = "";

			// $id = (!empty($_POST['id']) ? $_POST['id'] : null);

			// upload de l'image de chapitre
			include 'includes/image-upload.php';

			// si l'id existe déjà : update du chapitre
			// if (isset($_POST['id'])) {
				$chapter = new Chapter();
				$chapter->update($title, $author, $content, $id);
				if ($chapter_image) {
					$chapter->updateImage($chapter_image, $id);
					header("Location:index.php");
				} else {
					header("Location:index.php");
				}
			// }
		// conditions si les champs demandés ne sont pas renseignés
		// } elseif (!empty($_POST)) {
		// 	if (empty($_POST['title'])) {
		// 		$errors .= '<li>Le titre est obligatoire.</li>';
		// 	}
		// 	if (empty($_POST['author'])) {
		// 		$errors .= '<li>L\'auteur est obligatoire.</li>';
		// 	}
		// 	if (empty($_POST['content'])) {
		// 		$errors .= '<li>Le contenu est obligatoire.</li>';
		// 	}

		// 	$_SESSION['flash']['error'] = '<ul>' . $errors . '</ul>';
		// }	
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