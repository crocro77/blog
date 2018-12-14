<?php

require_once('includes/admin-template-loader.php');

class AdminAddEditControllerTest
{       
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
    }
}