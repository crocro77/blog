<?php

namespace Anthony\Blogalaska\Model;

require_once("model/Manager.php");

class Comment
{
  protected $id,
            $post_id,
            $author,
            $comment,
            $comment_date;
      
  public function __construct(array $data)
  {
    $this->hydrate($data);
  }

  public function id()
  {
    return $this->id;
  }

  public function post_id()
  {
    return $this->post_id;
  }

  public function author()
  {
    return $this->author;
  }

  public function comment()
  {
    return $this->comment;
  }

  public function comment_date()
  {
    return $this->comment_date;
  }
}