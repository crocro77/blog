<?php

class SingleController extends Controller
{
	public function execute() {
		// Si $_POST['author'] n'est pas vide OU qu'il est vide mais que $_SESSION['username'] existe et que $_POST['comment'] n'est pas vide
		if(!empty($_POST['author']) || (empty($_POST['author']) && isset($_SESSION['username']) && !empty($_POST['comment']))) {
			$comment = new Comment();
			$comment->setPostId($_GET['id']);
			if(isset($_SESSION['username'])) {
				$comment->setAuthor($_SESSION['username']);
			} else {
				$comment->setAuthor($_POST['author']);
			}
			$comment->setComment($_POST['comment']);
			$this->commentManager->add($comment);
			$_SESSION['flash']['success'] = 'Votre commentaire a bien été ajouté.';
		}

		if(isset($_GET['action'])) {
			if($_GET['action'] == 'signal') {
				$comment = $this->commentManager->getSpecificComment($_GET['commentId']);
				$this->commentManager->signal($comment);
				$_SESSION['flash']['success'] = 'Le commentaire a bien été signalé. Il sera modéré par l\'administrateur dès que possible.';
			}
		}

		$chapterUnique = $this->chapterManager->getUnique($_GET['id']);
		$listOfComments = $this->commentManager->getComments($_GET['id']);
		$numberOfComments = $this->commentManager->count($_GET['id']);

		$viewSingle = new ViewSingle($chapterUnique, $listOfComments, $numberOfComments);
		$viewSingle->display();
    }
}