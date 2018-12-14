<?php

require_once('includes/template-loader.php');

class BlogCommentChapterControllerTest
{
    public function executeCommentChapter() {
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
            include('includes/flash-msg.php');
            $_SESSION['flash']['success'] = 'Votre commentaire a bien été ajouté.'; 
            
        }
    }
}