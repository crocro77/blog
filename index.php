<?php
require("controller/FrontOffice.php");
require("controller/BackOffice.php");
setPaginationData();

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        // backend - admin
        // Edition -- A FAIRE
        // elseif($_GET['action'] == 'edit'){
	       //  if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0){
	       //      edit($_POST['newComment'], $_GET['id'], $_GET['post_id']);
	       //  }
	       //  else {
	       //    throw new Exception ('Bug');
	       //  }
        // }
        // }
        // Suppression -- A FAIRE
        // elseif ($_GET['action'] == 'delete') {
        //     if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0){
        //         if (isset($_POST['deleteComment'])) {
        //             delete($_POST['deleteComment'], $_GET['id'], $_GET['post_id']);
        //         }
        //         else {
        //             // Autre exception
        //             throw new Exception ('Bug');
        //         }
        //     }
        // }
        // LOGIN ADMIN -- A FAIRE
        // elseif ($_GET['action'] == 'login') {
        // }
    }
    else {
        listPosts();
    }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}
