<?php

require('includes/template-loader.php');

class AdminController
{
	public function executeAdminPanel() {
		
		$selectedTab = 'dashboard';

		$chapter = null;

		// onglet de l'espace admin
		if(isset($_GET['tab'])) {
			$selectedTab = $_GET['tab'];
		}

		// ajout et maj d'un contenu dans la bdd //
        $errors = '';
		if(!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['content'])) {
			$title = $_POST['title'];
			$author = $_POST['author'];
			$content = $_POST['content'];

			$id = (!empty($_POST['id']) ? $_POST['id'] : NULL);

			if(isset($_POST['id'])) {
				$this->chapterManager->update($title, $author, $content, $id);
			} else {
				$chapter = new Chapter();
				$chapter->setTitle($title);
				$chapter->setContent($content);
				$chapter->setAuthor($author);
				$chapter->add($chapter);
				header("Location:index.php");
			}
		} elseif(!empty($_POST)){
		    if(empty($_POST['title'])) {
                 $errors .= '<li>Le titre est obligatoire.</li>';
            }
            if(empty($_POST['author'])) {
                 $errors .= '<li>L\'auteur est obligatoire.</li>';
            }
            if(empty($_POST['content'])) {
                 $errors .= '<li>Le contenu est obligatoire.</li>';
            }

            $_SESSION['flash']['error'] = '<ul>' . $errors . '</ul>';
		}
		
		// ajout de l'image de chapitre
		// if(!empty($_FILES['image']['name'])){
        //     $file = $_FILES['image']['name'];
        //     $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
        //     $extension = strrchr($file,'.');

        //     if(!in_array($extension,$extensions)){
        //         $errors['image'] = "Cette image n'est pas valable";
        //     }
        // }

        // if(!empty($errors)){
        //     ?<>
        //         <div class="card red">
        //             <div class="card-content white-text">
        //                 <?php
        //                     foreach($errors as $error){
        //                         echo $error."<br/>";
        //                     }
        //                 ?<>
        //             </div>
        //         </div>
        //     <?php
        // }else{
        //     post($title,$content,$author);
        //     if(!empty($_FILES['image']['name'])){
        //         post_img($_FILES['image']['tmp_name'], $extension);
        //     }else{
        //         $id = $db->lastInsertId();
        //         header("Location:index.php?page=post&id=".$id);
		// 	}
		// }
		
		// suppression et edition des contenus //
		$chapterManager = new Chapter();
		if(isset($_GET['action'])) {
			if($_GET['action'] == 'delete') {
				$chapterManager->deleteChapter();
			} elseif($_GET['action'] == 'edit') {
				$chapter = $chapterManager->getUnique($_GET['id']);
			}
		}

		// gestionnaire des commentaires
		$commentManager = new Comment();
		if(isset($_GET['action'])) {
			if($_GET['action'] == 'validateComment') {
				$commentManager->validateComment($_GET['commentId']);
			} elseif($_GET['action'] == 'deleteComment') {
				$commentManager->deleteComment($_GET['commentId']);
			} elseif($_GET['action'] == 'seenComment') {
				$commentManager->seenComment($_GET['commentId']);
			}
		}

		$listOfchapters = $chapterManager->getList();
		$listOfComments = $commentManager->getAllComments();
		$signaledComments = $commentManager->getSignaledComments();
		
		// les infos sont transmises à la vue
		return load_template('admin/admin.php', array('listOfchapters' => $listOfchapters, 'selectedTab' => $selectedTab, 'chapter' => $chapter, 'signaledComments' => $signaledComments, 'listOfComments' => $listOfComments));
	}

	public function executeLogin() {

		// Si 'username' et 'password' sont corrects, la variable de session 'username' est créée.
		if(isset($_POST['username']) && $_POST['username'] == 'j.forteroche' && isset($_POST['password']) && $_POST['password'] == 'admin') {
			$_SESSION['username'] = $_POST['username'];
			// Redirection vers la page d'accueil.
			header('Location: index.php?p=admin');
		}

		return load_template('admin/login.php', array());
	}
}