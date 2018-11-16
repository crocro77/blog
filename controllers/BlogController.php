<?php

class BlogController
{
	public function executeHome()
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
    
    public function executeSingle() {
		// Si $_POST['author'] n'est pas vide OU qu'il est vide mais que $_SESSION['username'] existe et que $_POST['comment'] n'est pas vide
		$commentManager = new Comment();
		if(!empty($_POST['author']) || (empty($_POST['author']) && isset($_SESSION['username']) && !empty($_POST['comment']))) {
			$comment = new Comment();
			$comment->setPostId($_GET['id']);
			if(isset($_SESSION['username'])) {
				$comment->setAuthor($_SESSION['username']);
			} else {
				$comment->setAuthor($_POST['author']);
			}
			$comment->setComment($_POST['comment']);
			$commentManager->add($comment);
			$_SESSION['flash']['success'] = 'Votre commentaire a bien été ajouté.';
		}

		if(isset($_GET['action'])) {
			if($_GET['action'] == 'signal') {
				$comment = $commentManager->getSpecificComment($_GET['commentId']);
				$commentManager->signal($comment);
				$_SESSION['flash']['success'] = 'Le commentaire a bien été signalé. Il sera modéré par l\'administrateur dès que possible.';
			}
		}

		$chapterManager = new Chapter();
		$chapterUnique = $chapterManager->getUnique($_GET['id']);
		$listOfComments = $commentManager->getComments($_GET['id']);

		return $this->load_template('single.php', array('chapterUnique' => $chapterUnique, 'listOfComments' => $listOfComments));
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