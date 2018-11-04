<?php

namespace Anthony\BlogAlaska\Model;

use Anthony\BlogAlaska\Model\ObjectModel;

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

    public function email()
    {
        return $this->email;
    }

    public function seen()
    {
        return $this->seen;
    }
}
