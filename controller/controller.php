<?php

require_once("model/PostManager.php");
require_once("model/CommentManager.php");

use \Anthony\Blog_Alaska\Model\PostManager;
use \Anthony\Blog_Alaska\Model\CommentManager;

function paginatedListPost()
{
    $postPerPage = 4;
    $postManager = new PostManager();
    $postsNumber = $postManager->getPostsNumber();
    $pageNumber = ceil($postsNumber/$postPerPage);

    if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $pageNumber) {
        $currentPage = $_GET['p'];
    }
    else
    {
        $currentPage = 1;
    }
    
    $posts = $postManager->getPosts($currentPage, $postPerPage);
    
    require('view/listPostsView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/postView.php');
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
