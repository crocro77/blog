<?php

namespace Anthony\Blogalaska\Model;

use Anthony\Blog_Alaska\Model\ObjectModel;

require_once("model/Manager.php");

class Comment extends ObjectModel
{
  protected $id,
    $post_id,
    $author,
    $comment,
    $comment_date,
    $email,
    $seen;

  public function __construct(array $datas)
  {
    $this->hydrate($datas);
  }

  public function hydrate(array $datas)
  {
    foreach ($datas as $key => $value) {
      $method = 'set' . ucfirst($key);

      if (method_exists($this, $method))
        $this->$method($value);
      else throw new Exception("Exception | " . $method . "() : La méthode invoquée n'existe pas");
    }
  }

    // GETTERS
  public function getId()
  {
    return $this->_id;
  }

  public function getPostId()
  {
    return $this->_post_id;
  }

  public function getComment()
  {
    return $this->_comment;
  }

  public function getAuthor()
  {
    return $this->_author;
  }

  public function getEmail()
  {
    return $this->_email;
  }

  public function getCommentDate()
  {
    return $this->_comment_date;
  }

  public function getSeen()
  {
    return $this->_seen;
  }

    // SETTERS
  public function setId($id)
  {
    $id = (int)$id;

    if ($id > 0) {
      $this->_id = $id;
    }
  }

  public function setPostId($post_id)
  {
    $post_id = (int)$post_id;

    if ($post_id > 0) {
      $this->_post_id = $post_id;
    }
  }

  public function setAuthor($author)
  {
    if (is_string($author) && strlen($author) <= 255) {
      $this->_author = $author;
    }
  }

  public function setComment($comment)
  {
    if (is_string($conmment)) {
      $this->_comment = $comment;
    }
  }

  public function setCommentDate($comment_date)
  {
    if (is_string($comment_date) && strlen($comment_date) < 255) {
      $this->_comment_date = $comment_date;
    }
  }

  public function setEmail($email)
  {
    if (is_string($email) && strlen($email) < 255) {
      $this->_email = $email;
    }
  }

  public function setSeen($seen)
  {
    $seen = (boolean) $seen;

    if ($seen = 0 || $seen = 1) {
      $this->_seen = $seen;
    }
  }
}
