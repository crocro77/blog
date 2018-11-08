<?php

require_once("model/AdminManager.php");
require_once("model/DashboardManager.php");
require_once("model/AdminPostManager.php");
require_once("model/AdminCommentManager.php");

use \Anthony\Blog_Alaska\Admin\AdminManager;
use \Anthony\Blog_Alaska\Admin\AdminCommentManager;
use \Anthony\Blog_Alaska\Admin\AdminPostManager;
use \Anthony\Blog_Alaska\Admin\DashboardManager;

function Admin()
{
	$adminManager = new AdminManager();
    $Admin = $adminManager->is_admin($email,$password);
}

function DashboardTable()
{
	inTable($table);
    getColor($table,$colors);
    
    require('view/dashboard.php');
}

function ListPosts()
{
    $adminPostManager = new AdminPostManager(); 
    $posts = $adminPostManager->get_posts();

    require('view/list.php');
}

function SinglePost()
{
    $adminPostManager = new AdminPostManager();
    $post = $adminPostManager->get_post();

    require('view/post.php');
}

function CreatePost($title,$content,$posted)
{
    $adminPostManager = new AdminPostManager();

    $affectedLines = $adminPostManager->post($title,$content,$posted);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le chapitre !');
    }
    else {
        header('Location: index.php?action=post&id=' . $_GET['id']);
    }
    
    require('view/write.php');
}

function EditPost($title,$content,$posted,$id)
{
	$adminPostManager = new AdminPostManager();

	$affectedLines = $adminPostManager->edit($title,$content,$posted,$id);

	if ($affectedLines === false) {
		throw new Exception('Impossible d\'éditer le commentaire !');
	}
	else {
		header('Location: index.php?action=post&id=' . $_GET['id']);
    }
        
    require('view/post.php');
}

function PostImage($tmp_name, $extension)
{
	$adminPostManager = new AdminPostManager();
    $postimage = $adminPostManager->post_img($tmp_name, $extension);
        
    require('view/write.php');
}

function GetComments()
{
    $adminCommentManager = new AdminCommentManager();
    $comments = $adminCommentManager->get_comments();

    require('view/dashboard.php');
}

function EditComment($comment_edited,$id)
{
	$adminCommentManager = new AdminCommentManager();
    $editcomment = $adminCommentManager->edit_comment($comment_edited,$id);

    require('view/dashboard.php');
}