<?php
require('controller/frontend.php');

try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
               // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
               throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'edit') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0){
                if (isset($_POST['newComment'])) {
                    edit($_POST['newComment'], $_GET['id'], $_GET['post_id']);
                }
                else {
                    // Autre exception
                    throw new Exception ('Bug');
                }
        }
        elseif ($_GET['delete'] == 'delete') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0){
                if (isset($_POST['deleteComment'])) {
                    delete($_POST['deleteComment'], $_GET['id'], $_GET['post_id']);
                }
                else {
                    // Autre exception
                    throw new Exception ('Bug');
                }
            }
        }
      }   
    }
    else {
        listPosts();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
