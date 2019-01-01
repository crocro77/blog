<?php

require_once('includes/template-loader.php');

class FrontController
{
	public function executeHome()
	{
		// Nombre de chapitre voulu par page.
		$chaptersPerPage = 4;

		// On compte le nombre total de chapitre présents dans la bdd.
		$chapterManager = new Chapter();
		$numberOfChapters = $chapterManager->count();

		// Nombre de pages.
		$numberOfPages = ceil($numberOfChapters / $chaptersPerPage);

		$currentPage = 1;
		
		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$currentPage = intval($_GET['page']);

			if ($currentPage > $numberOfPages) {
				$currentPage = $numberOfPages;
			}
		} else {
			$currentPage = 1;
		}
		
		$firstChapter = ($currentPage - 1) * $chaptersPerPage;
		$listOfChapters = $chapterManager->getList($firstChapter, $chaptersPerPage);

		return load_template('front/home.php', array('listOfChapters' => $listOfChapters, 'numberOfPages' => $numberOfPages, 'currentPage' => $currentPage));
    }
    
    public function executeSingleChapter()
    {
		// récupération d'un chapitre et de ses commentaires
		if(isset($_GET['id'])) {
			$chapterManager = new Chapter();
			$chapterUnique = $chapterManager->getUnique($_GET['id']);
			$commentManager = new Comment();
			$listOfComments = $commentManager->getChapterComments($_GET['id']);
	
			return load_template('front/single.php', array('chapterUnique' => $chapterUnique, 'listOfComments' => $listOfComments));
		}
    }

    public function executeCommentChapter()
    {
		// ajout d'un commentaire
		if(isset($_GET['id'])) {
			if(!empty($_POST['author']) || (empty($_POST['author']) && isset($_SESSION['username']) && !empty($_POST['comment']))) {
				$comment = new Comment();
				$comment->setPostId($_GET['id']);
				if(isset($_SESSION['username'])) {
					$comment->setAuthor($_SESSION['username']);
				} else {
					$comment->setAuthor($_POST['author']);
				}
				$comment->setComment($_POST['comment']);
				$commentManager = new Comment();
				$commentManager->add($comment);
				header('Location: index.php?p=single&id='.($_GET['id']).'#comments');
			}
		}
    }

    public function executeSignalComment($commentId)
    {    
		// signalement d'un commentaire
		if(isset($_GET['id'])) {
			$commentManager = new Comment();
			$comment = $commentManager->getSpecificComment($_GET['commentId']);
			$commentManager->signal($comment);
			header('Location: index.php?p=single&id='.($_GET['id']).'#comments');
		}
    }
}