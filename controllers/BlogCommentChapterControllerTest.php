<?php

require_once('includes/template-loader.php');

class BlogCommentChapterControllerTest
{
    public function executeCommentChapter() {
        // ajout d'un commentaire
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

        // signalement d'un commentaire
        if(isset($_GET['action'])) {
			if($_GET['action'] == 'signal') {
                $commentManager = new Comment();
				$comment = $commentManager->getSpecificComment($_GET['commentId']);
				$commentManager->signal($comment);
				$_SESSION['flash']['success'] = 'Le commentaire a bien été signalé. Il sera modéré par l\'administrateur dès que possible.';
				include('includes/flash-msg.php');
			}
		}
    }
}