<?php

class HomeController
{
	public function execute()
	{
		// Nombre de chapitre que l'on veut par page.
		$chaptersPerPage = 4;

		// On compte le nombre total de chapitre présents dans la bdd.
		$chapterManager = new Chapter();
		$numberOfChapters = $chapterManager->count();

		// Nombre de pages.
		$numberOfPages = ceil($numberOfChapters / $chaptersPerPage);

		if (isset($_GET['page']) && empty($_GET['page'])) {
			$currentPage = 1;
		} elseif (isset($_GET['page']) && !empty($_GET['page'])) {
			$currentPage = intval($_GET['page']);

			if ($currentPage > $numberOfPages) {
				$currentPage = $numberOfPages;
			}
		} else {
			$currentPage = 1;
		}

		$firstChapter = ($currentPage - 1) * $chaptersPerPage;
		$listOfChapters = $chapterManager->getList($firstChapter, $chaptersPerPage);

		return $this->load_template('home.php', array('listOfChapters' => $listOfChapters, 'numberOfPages' => $numberOfPages, 'currentPage' => $currentPage));
	}

	/**
	 * Template loader
	 * @param $template_name
	 * @param array $data
	 * @return string
	 */

	function load_template($template_name, $data = array())
	{
    	//Extract variables from the array
		extract($data);

    	//Getting template content
		ob_start();
		include 'views/' . (string)$template_name;
		$template = ob_get_contents();
		ob_end_clean();
		return $template;
	}
}