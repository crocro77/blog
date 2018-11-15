<?php

class AdminController extends Database
{
	public function execute() {
		
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
				$this->chapterManager->add($chapter);
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
		if(isset($_GET['action'])) {
			if($_GET['action'] == 'delete') {
				$this->chapterManager->deleteChapter();
			} elseif($_GET['action'] == 'edit') {
				$chapter = $this->chapterManager->getUnique($_GET['id']);
			}
		}

		// gestionnaire des commentaires
		if(isset($_GET['action'])) {
			if($_GET['action'] == 'validateComment') {
				$this->commentManager->validateComment($_GET['commentId']);
			} elseif($_GET['action'] == 'deleteComment') {
				$this->commentManager->deleteComment($_GET['commentId']);
			} elseif($_GET['action'] == 'seenComment') {
				$this->commentManager->seenComment($_GET['commentId']);
			}
		}

		$listOfchapters = $this->chapterManager->getList();
		$listOfComments = $this->commentManager->getAllComments();
		$signaledComments = $this->commentManager->getSignaledComments();
		
		// les infos sont transmises à la vue
		$viewAdmin = new ViewAdmin($listOfchapters, $selectedTab, $chapter, $signaledComments, $listOfComments);
		$viewAdmin->display();
	}
}