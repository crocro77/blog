<?php

require_once('Model/PostManager.php');
require_once('Model/CommentManager.php');

use Anthony\BlogAlaska\Model\PostManager;
use Anthony\BlogAlaska\Model\CommentManager;

function list_posts()
{
    $postManager = new PostManager();
    $posts = $postManager->get_posts();

    require('View/home.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->get_post($_GET['id']);
    $comments = $commentManager->get_comments($_GET['id']);

    require('View/postView.php');
}

function chapters()
{
    $postManager = new PostManager();

    $chapters = $postManager->get_chapters();

    require('View/chapters.php');
}

function add_comment($name,$email,$comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->post_comment($name,$email,$comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $_GET['id']);
    }
}