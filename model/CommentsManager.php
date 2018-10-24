<?php
class Comments
{
  protected $id,
    	      $post_id,
            $author,
            $comment,
            $comment_date;
    
  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
  }
  
  public function id()
  {
    return $this->$id;
  }

  public function idPost()
  {
    return $this->$idPost;
  }
  
  public function dateComment()
  {
    return $this->$dateComment;
  }
  
  public function author()
  {
    return $this->$author;
  }
  
  public function content()
  {
    return $this->$content;
  }
}
?>