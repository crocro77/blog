<?php

require_once('includes/template-loader.php');

class BlogSingleChapterControllerTest
{
    public function executeSingleChapter() {
		$chapterManager = new Chapter();
		$chapterUnique = $chapterManager->getUnique($_GET['id']);
		$commentManager = new Comment();
		$listOfComments = $commentManager->getChapterComments($_GET['id']);

		return load_template('front/single.php', array('chapterUnique' => $chapterUnique, 'listOfComments' => $listOfComments));
    }
}