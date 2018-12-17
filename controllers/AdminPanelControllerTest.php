<?php

require_once('includes/template-loader.php');

class AdminPanelControllerTest
{
	public function executeAdminPanel()
	{
		$selectedTab = 'dashboard';
        $chapter = null;
        $chapterManager = new Chapter();
        $listOfchapters = $chapterManager->getList();
        $commentManager = new Comment();
        $listOfComments = $commentManager->getAllComments();
		$signaledComments = $commentManager->getSignaledComments();

		// onglet de l'espace admin
		if (isset($_GET['tab'])) {
			$selectedTab = $_GET['tab'];
		}

        // suppression et edition des contenus //
		if (isset($_GET['action'])) {
			if ($_GET['action'] == 'delete') {
				$chapterManager->deleteChapter();
				header("Location:index.php?p=admin&tab=list");
			} elseif ($_GET['action'] == 'edit') {
				$chapter = $chapterManager->getUnique($_GET['id']);
			}
        }

        // gestionnaire des commentaires
		if (isset($_GET['action'])) {
			if ($_GET['action'] == 'validateComment') {
                $commentManager->validateComment($_GET['commentId']);
                header("Location:index.php?p=admin&tab=comments");
			} elseif ($_GET['action'] == 'deleteComment') {
                $commentManager->deleteComment($_GET['commentId']);
                header("Location:index.php?p=admin&tab=comments");
			} elseif ($_GET['action'] == 'seenComment') {
                $commentManager->seenComment($_GET['commentId']);
                header("Location:index.php?p=admin&tab=comments");
			}
        }
        
		return load_template('admin/admin.php', array('signaledComments' => $signaledComments, 'listOfComments' => $listOfComments, 'listOfchapters' => $listOfchapters, 'selectedTab' => $selectedTab, 'chapter' => $chapter));
    }
}