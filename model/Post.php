<?php

namespace Anthony\Blogalaska\Model;

use Anthony\Blog_Alaska\Model\ObjectModel;

require_once("model/Manager.php");

class Post extends ObjectModel
{
	protected $id,
			$date,
            $title,
            $content,
			$author,
			$chapter_image,
			$posted;

	public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value)
        {
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

    public function getTitle()
    {
        return $this->_title;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getAuthor()
    {
        return $this->_author;
    }

    public function getChapterImage()
    {
        return $this->_chapter_image;
    }

    public function getDate()
    {
        return $this->_date;
	}
	
	public function getPosted()
	{
		return $this->_posted;
	}

    // SETTERS
    public function setId($id)
    {
        $id = (int) $id;

        if($id > 0)
        {
            $this->_id = $id;
        }
    }

    public function setTitle($title)
    {
        if (is_string($title) && strlen($title) <= 255)
        {
            $this->_title = $title;
        }
    }

    public function setContent($content)
    {
        if (is_string($content))
        {
            $this->_content = $content;
        }
    }

    public function setAuthor($author)
    {
        if(is_string($author) && strlen($author) <= 255)
        {
            $this->_author = $author;
        }
    }

    public function setDate($date)
    {
        if (is_string($date) && strlen($date) < 255)
        {
            $this->_date = $date;
        }
    }

    public function setChapterImage($chapter_image)
    {
        if (is_string($chapter_image) && strlen($chapter_image) < 255)
        {
            $this->_chapter_image = $chapter_image;
        }
	}
	
	public function setPosted($posted)
    {
        $posted = (boolean) $posted;

        if($posted = 0 || $posted = 1)
        {
            $this->_posted = $posted;
        }
    }
}