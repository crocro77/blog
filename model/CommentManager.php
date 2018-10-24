<?php
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
  
  // public function id()
  // {
  //   return $this->$id;
  // }

  // public function post_id()
  // {
  //   return $this->$post_id;
  // }
  
  // public function dateComment()
  // {
  //   return $this->$dateComment;
  // }
  
  // public function author()
  // {
  //   return $this->$author;
  // }
  
  // public function content()
  // {
  //   return $this->$content;
  // }

  public function getComments($postId)
  {
    $db = dbConnect();
      $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
      $comments->execute(array($postId));
  
      return $comments;
  }
  
  public function postComment($postId, $author, $comment)
  {
      $db = dbConnect();
      $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
      $affectedLines = $comments->execute(array($postId, $author, $comment));
  
      return $affectedLines;
  }
}
?>