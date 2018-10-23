<?php
class Posts
{
  protected $id,
            $date,
            $title,
            $content,
            $author,
            $lastedited;
    
  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
  }
  
  public function id()
  {
    return $this->$id;
  }
  
  public function date()
  {
    return $this->$date;
  }
  
  public function title()
  {
    return $this->$title;
  }

  public function content()
  {
    return $this->$content;
  }

  public function author()
  {
    return $this->$author;
  }

  public function lastedited()
  {
    return $this->$lastedited;
  }
}
?>