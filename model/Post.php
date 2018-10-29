<?php

namespace Anthony\Blogalaska\Model;

require_once("model/Manager.php");

class Post extends ObjectModel
{
	protected $id,
			$date,
            $title,
            $content,
			$author,
			$chapter_image;

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

	public function chapter_image()
	{
		return $this->chapter_image();
	}
}

?>