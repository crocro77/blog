<?php

namespace Anthony\Blogalaska\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
  protected $id,
    $post_id,
    $author,
    $comment,
    $comment_date;
    
  // public function __construct(array $donnees)
  // {
  //   $this->hydrate($donnees);
  // }

  public function id()
  {
    return $this->$id;
  }

  public function post_id()
  {
    return $this->$post_id;
  }

  public function author()
  {
    return $this->$author;
  }

  public function comment()
  {
    return $this->$comment;
  }

  public function comment_date()
  {
    return $this->$comment_date;
  }

  public function getComments($post_id)
  {
    $db = $this->dbConnect();
    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    $comments->execute(array($post_id));

    return $comments;
  }

  public function postComment($post_id, $author, $comment)
  {
    $db = $this->dbConnect();
    $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
    $affectedLines = $comments->execute(array($post_id, $author, $comment));

    return $affectedLines;
  }

  public function editComment($newComment, $post_id)
  {
      $db = $this->dbConnect();
      $newComment = $db->prepare('UPDATE comments SET comment = ? WHERE id=?');
      $affectedComment = $newComment->execute(array($newComment, $post_id));

      return $affectedComment;
  }
}
?>