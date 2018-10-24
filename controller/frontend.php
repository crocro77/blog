<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new \Anthony\Blogalaska\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new \Anthony\Blogalaska\Model\PostManager();
    $commentManager = new \Anthony\Blogalaska\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($post_id, $author, $comment)
{
    $commentManager = new \Anthony\Blogalaska\Model\CommentManager();

    $affectedLines = $commentManager->postComment($post_id, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $post_id);
    }
}

function edit($newComment, $id, $post_id)
{
    $commentManager = new \Anthony\Blog\Model\CommentManager();
  
    $affectedComment = $commentManager->editComment($newComment,$post_id);
  
    require('view/frontend/postView.php');
  
    if ($affectedComment == false){
        throw new Exception('Impossible d\'editer le commentaire !');
    }
    else {
        header('Location : index.php?action=post&id=' . $post_id);
    }
}