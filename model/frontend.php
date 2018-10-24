<?php
function getPosts()
{
	$db = dbConnect();
	$req = $db->query('SELECT id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr, author FROM posts ORDER BY id'); 

	return $req;
}

function getPost($post_id)
{
	$db = dbConnect();
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr, author FROM posts ORDER BY id');
    $req->execute(array($post_id));
    $post = $req->fetch();
    
    return $post;
}

function getComments($post_id)
{
	$db = dbConnect();
    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    $comments->execute(array($post_id));

    return $comments;
}

function dbConnect()
{
    $db = new PDO('mysql:host=localhost;dbname=blog_alaska;charset=utf8', 'root', '');
    return $db;
}

function postComment($post_id, $author, $comment)
{
    $db = dbConnect();
    $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
    $affectedLines = $comments->execute(array($post_id, $author, $comment));

    return $affectedLines;
}