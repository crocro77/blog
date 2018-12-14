<?php

require_once('includes/template-loader.php');

class BlogSingleChapterControllerTest
{
    public function executeSingleChapter() {
		$chapterManager = new Chapter();
		$chapterUnique = $chapterManager->getUnique($_GET['id']);
		$commentManager = new Comment();
		$listOfComments = $commentManager->getChapterComments($_GET['id']);

		if(isset($_GET['action'])) {
			if($_GET['action'] == 'signal') {
				$comment = $commentManager->getSpecificComment($_GET['commentId']);
				$commentManager->signal($comment);
				$_SESSION['flash']['success'] = 'Le commentaire a bien été signalé. Il sera modéré par l\'administrateur dès que possible.';
				include('includes/flash-msg.php');
			}
		}

		return load_template('front/single.php', array('chapterUnique' => $chapterUnique, 'listOfComments' => $listOfComments));
    }
}