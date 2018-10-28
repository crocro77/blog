<?php

namespace Anthony\Blog_Alaska\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
	public function getPosts()
	{
	    $db = self::dbConnect();
	    $req = $db->query('SELECT id, title, content, author, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts ORDER BY id'); 

	    return $req;
	}

	public function getPost($postId)
	{
	    $db = self::dbConnect();
	    $req = $db->prepare('SELECT id, title, content, author, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts WHERE id = ?');
	    $req->execute(array($postId));
	    $post = $req->fetch();
	    
	    return $post;
	}
	
	// CREATION DE POST -- A FAIRE
	// public function createPost()
	// {
	// 	$db = $this->dbConnect();
	// 	extract($_POST);
	//     $req = $db->prepare('INSERT into posts (title, content) VALUES ($title, $content,)');
	//     header("Location: index.php");
	// }
}