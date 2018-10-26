<?php

require_once("model/PostManager.php");
require_once("model/CommentManager.php");

use \Anthony\Blog_Alaska\Model\PostManager;
use \Anthony\Blog_Alaska\Model\CommentManager;

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

// Edition du commentaire -- A FAIRE
// function edit($newComment, $commentID, $postID)
// {
//     $commentManager = new CommentManager();
   
//     $affectedComment = $commentManager->editComment($newComment,$commentID);
   
//     require('view/frontend/commentView.php');
   
//     if ($affectedComment == false){
//         throw new Exception('Impossible d\'editer le commentaire !');
//     }
//     else {
//         header('Location : index.php?action=post&id=' .$postID);
//     }
// }
// Suppression du commenaitre -- A FAIRE
// function delete()
// {

// }
// Création d'un nouveau post -- A FAIRE
// function createPost()
// {

// }