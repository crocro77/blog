<?php

require_once('includes/template-loader.php');

class BlogHomeControllerTest
{
	public static function executeHome()
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
}