<?php

namespace Anthony\Blogalaska\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
  protected $id,
            $date,
            $title,
            $content,
            $author;

  // public function __construct(array $donnees)
  // {
  //   $this->hydrate($donnees);
  // }

  // public function id()
  // {
  //   return $this->$id;
  // }

  // public function date()
  // {
  //   return $this->$date;
  // }

  // public function title()
  // {
  //   return $this->$title;
  // }

  // public function content()
  // {
  //   return $this->$content;
  // }

  // public function author()
  // {
  //   return $this->$author;
  // }

  public function getPosts()
  {
    $db = $this->dbConnect();
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr, author FROM posts ORDER BY id');

    return $req;
  }

  public function getPost($postId)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr, author FROM posts ORDER BY id');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
  }

  public function createPost()
  {
    $db = $this->dbConnect();
    extract($_POST);
    $req = $db->prepare('INSERT into posts (title, content) VALUES ($title, $content,)');
    header("Location: index.php");
  }
}
?>