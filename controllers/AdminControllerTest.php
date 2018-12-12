<?php

require_once('includes/template-loader.php');

class AdminControllerTest
{
	public function executeAdminPanel()
	{

		$selectedTab = 'dashboard';

		$chapter = null;

		// onglet de l'espace admin
		if (isset($_GET['tab'])) {
			$selectedTab = $_GET['tab'];
		}

		return load_template('admin/admin.php', array('selectedTab' => $selectedTab, 'chapter' => $chapter));
    
    }

    public function executeAddEditChapter()
    {
		// ajout et maj d'un contenu dans la bdd //
		$errors = '';
		if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['content'])) {
			$title = $_POST['title'];
			$author = $_POST['author'];
			$content = $_POST['content'];
			$chapter_image = "";

			$id = (!empty($_POST['id']) ? $_POST['id'] : null);

			// upload de l'image de chapitre
			if (isset($_FILES['file'])) {
				$file = $_FILES['file']['name'];
				$max_size = 2000000;
				$size = $_FILES['file']['size'];
				$extensions = array('.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF');
				$extension = strrchr($file, '.');

				if (!in_array($extension, $extensions)) {
					$error = "Cette image n'est pas valable";
				}

				if ($size > $max_size) {
					$error = "Le fichier est trop volumineux";
				}

				if (!isset($error)) {
					$key = $_POST['title'] . time() . $extension;
					move_uploaded_file($_FILES['file']['tmp_name'], 'public/img/' . $key);
					$chapter_image = $key;
				}
			}

			if (isset($_POST['id'])) {
				$chapter = new Chapter();
				$chapter->update($title, $author, $content, $id);
				if ($chapter_image) {
					$chapter->updateImage($chapter_image, $id);
					header("Location:index.php");
				} else {
					header("Location:index.php");
				}
			} else {
				$chapter = new Chapter();
				$chapter->setTitle($title);
				$chapter->setContent($content);
				$chapter->setAuthor($author);
				if ($chapter_image) {
					$chapter->setChapterImage($chapter_image);
				}
				$chapter->add($chapter);
				header("Location:index.php");
			}
		} elseif (!empty($_POST)) {
			if (empty($_POST['title'])) {
				$errors .= '<li>Le titre est obligatoire.</li>';
			}
			if (empty($_POST['author'])) {
				$errors .= '<li>L\'auteur est obligatoire.</li>';
			}
			if (empty($_POST['content'])) {
				$errors .= '<li>Le contenu est obligatoire.</li>';
			}

			$_SESSION['flash']['error'] = '<ul>' . $errors . '</ul>';
		}
		
		$listOfchapters = $chapterManager->getList();
		$listOfComments = $commentManager->getAllComments();
		$signaledComments = $commentManager->getSignaledComments();

		return load_template('admin/admin.php', array('listOfchapters' => $listOfchapters, 'selectedTab' => $selectedTab, 'chapter' => $chapter, 'signaledComments' => $signaledComments, 'listOfComments' => $listOfComments));
    
    }

    public function executeChapterManager()
    {
        // suppression et edition des contenus //
		$chapterManager = new Chapter();
		if (isset($_GET['action'])) {
			if ($_GET['action'] == 'delete') {
				$chapterManager->deleteChapter();
				header("Location:index.php?p=admin&tab=list");
			} elseif ($_GET['action'] == 'edit') {
				$chapter = $chapterManager->getUnique($_GET['id']);
			}
		}
		
		$listOfchapters = $chapterManager->getList();

		return load_template('admin/admin.php', array('listOfchapters' => $listOfchapters, 'chapter' => $chapter));
    
    }

    public function executeCommentManager()
    {
    	// gestionnaire des commentaires
		$commentManager = new Comment();
		if (isset($_GET['action'])) {
			if ($_GET['action'] == 'validateComment') {
				$commentManager->validateComment($_GET['commentId']);
			} elseif ($_GET['action'] == 'deleteComment') {
				$commentManager->deleteComment($_GET['commentId']);
			} elseif ($_GET['action'] == 'seenComment') {
				$commentManager->seenComment($_GET['commentId']);
			}
        }

		$listOfComments = $commentManager->getAllComments();
		$signaledComments = $commentManager->getSignaledComments();

		return load_template('admin/admin.php', array('signaledComments' => $signaledComments, 'listOfComments' => $listOfComments));
    
    }
        public function executeLogin()
	{

		// Si 'username' et 'password' sont corrects, la variable de session 'username' est créée.
		if (isset($_POST['username']) && $_POST['username'] == 'j.forteroche' && isset($_POST['password']) && $_POST['password'] == 'admin') {
			$_SESSION['username'] = $_POST['username'];
			// Redirection vers la page d'accueil.
			header('Location: index.php?p=admin');
		}

		return load_template('admin/login.php', array());
	}

	public function executeLogout()
	{
		session_destroy();
		header('Location: index.php');
	}
}
