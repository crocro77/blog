<?php

class HomeController extends Database
{
	public function execute() {
		// Nombre de chapitre que l'on veut par page.
		$chaptersPerPage = 4;

		// On compte le nombre total de chapitre présents dans la bdd.
		$numberOfChapters = $this->chapterManager->count();

		// Nombre de pages.
		$numberOfPages = ceil($numberOfChapters / $chaptersPerPage);

		if(isset($_GET['page']) && empty($_GET['page'])) {
			$currentPage = 1;
		} elseif(isset($_GET['page']) && !empty($_GET['page'])) {
			$currentPage = intval($_GET['page']);

			if($currentPage > $numberOfPages) {
				$currentPage = $numberOfPages;
			}
		} else {
			$currentPage = 1;
		}

		$firstChapter = ($currentPage - 1) * $chaptersPerPage;
		$listOfChapters = $this->chapterManager->getList($firstChapter, $chaptersPerPage);

		$viewHome = new ViewHome($listOfChapters, $numberOfPages, $currentPage);
		$viewHome->display();
	}
}