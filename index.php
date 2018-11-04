<?php

session_start();

require('Controller/controller.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'list_posts') {
            list_posts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                echo 'Erreur : aucun identifiant de billet envoyé';
            }
        }
        elseif ($_GET['action'] == 'add_comment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['email'], $_POST['comment']);
                }
                else {
                    echo 'Erreur : tous les champs ne sont pas remplis !';
                }
            }
            else {
                echo 'Erreur : aucun identifiant de billet envoyé';
            }
        }
    }
    else {
        list_posts();
    }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/error.php');
}