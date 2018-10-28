<?php

namespace Anthony\Blogalaska\Model;

require_once("model/Manager.php");

class Post
{
	protected $id,
			$date,
            $title,
            $content,
            $author;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function id()
	{
		return $this->id;
	}

	public function date()
	{
		return $this->date;
	}

	public function title()
	{
		return $this->title;
	}

	public function content()
	{
		return $this->content;
	}

	public function author()
	{
		return $this->author;
	}
}

?>