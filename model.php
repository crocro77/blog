<?php
function getPosts()
{
	$db = dbConnect();
	$req = $db->query('SELECT id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr, author FROM posts ORDER BY id'); 

	return $req;
}

function getPost($postId)
{
	$db = dbConnect();
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr, author FROM posts ORDER BY id');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}

function getComments($postId)
{
	$db = dbConnect();
    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    $comments->execute(array($postId));

    return $comments;
}

// Nouvelle fonction qui nous permet d'éviter de répéter du code
function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=blog_alaska;charset=utf8', 'root', '');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}
