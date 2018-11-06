<?php

namespace Anthony\Blog_Alaska\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
	public function getPosts($currentPage, $postPerPage)
	{
		$db = $this->dbConnect();
		$req = $db->query("SELECT id, title, content, author, chapter_image, DATE_FORMAT(date, '%d/%m/%Y à %Hh%i') AS creation_date_fr FROM posts ORDER BY id LIMIT ".(((int)$currentPage-1)*(int)$postPerPage).", ".(int)$postPerPage);
		return $req;
	}

	public function getPost($postId)
	{
	    $db = $this->dbConnect();
	    $req = $db->prepare('SELECT id, title, content, author, chapter_image, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts WHERE id = ?');
	    $req->execute(array($postId));
	    $post = $req->fetch();
	    
	    return $post;
	}

	public function getPostsNumber()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT COUNT(id) as postAmount FROM posts');
		$reqResult = $req->fetch();
		$postsNumber = $reqResult['postAmount'];
		return $postsNumber;
	}
}