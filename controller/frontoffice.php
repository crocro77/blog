<?php

require_once("model/PostManager.php");
require_once("model/CommentManager.php");

use \Anthony\Blog_Alaska\Model\PostManager;
use \Anthony\Blog_Alaska\Model\CommentManager;

setPaginationData();
$currentPage;

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view/frontoffice/listPostsView.php');
}

function setPaginationData()
{
    $postPerPage = 3;

    $currentPage = 1;

    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    $postsNumber = $postManager->getPostsNumber();


    $pageNumber = ceil($postsNumber/$postPerPage);

    if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $pageNumber) {
        $currentPage = $_GET['p'];
    }
    else
    {
        $currentPage = 1;
    }

    require('view/frontoffice/listPostsView.php');
}


function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontoffice/postView.php');
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
