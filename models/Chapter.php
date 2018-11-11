<?php

class Chapter
{
	private $id;
	private $title;
	private $content;
	private $author;
	private $date;
    private $chapter_image;

	public function __construct($value = [])
	{
		if(!empty($value))
		{
			$this->hydrate($value);
		}
	}

	public function hydrate($data)
	{
		foreach($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if(method_exists([$this, $method]))
			{
				$this->$method($value);
			}
		}
	}

	// SETTERS

	/**
	 * Permet d'assigner une valeur à l'attribut 'id'.
	 * @param int $id L'id
	 */
	public function setId($id)
	{
		if(is_int($id) && $id > 0)
		{
			$this->id = $id;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'title'.
	 * @param string $title Le titre
	 */
	public function setTitle($title)
	{
		if(is_string($title) && !empty($title)) {
			$this->title = $title;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'content'.
	 * @param string $content Le contenu
	 */
	public function setContent($content)
	{
		if(is_string($content) && !empty($content)) 
		{
			$this->content = $content;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'author'.
	 * @param string $author l'auteur
	 */
	public function setAuthor($author)
	{
		if(is_string($author) && !empty($author)) 
		{
			$this->author = $author;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'date'.
	 * @param DateTime $date La date de publication
	 */
	public function setDate(DateTime $date)
	{
		$this->date = $date;
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'chapter_image'.
	 * @param string $chapter_image L'image d'illustration du chapitre
	 */
	public function setChapterImage($chapter_image)
	{
		if(is_string($chapter_image) && !empty($chapter_image)) 
		{
			$this->chapter_image = $chapter_image;
		}
    }

	// GETTERS

	/**
	 * Obtient l'id du chapter.
	 * @return int L'id
	 */
	public function getId() {
		return $this->id; 
	}

	/**
	 * Obtient le titre du chapter.
	 * @return string Le titre
	 */
	public function getTitle() {
		return $this->title; 
	}

	/**
	 * Obtient le contenu du chapter.
	 * @return string Le contenu
	 */
	public function getContent() {
		return $this->content; 
	}

	/**
	 * Obtient l'auteur du chapter.
	 * @return string L'auteur
	 */
	public function getAuthor() {
		return $this->author; 
	}

	/**
	 * Obtient la date de publication du chapter.
	 * @return DateTime Object La date de publication
	 */
	public function getDate() {
		return $this->date; 
	}

	/**
	 * Obtient l'image du chapitres.
	 * @return string l'image du chapitre
	 */
	public function getChapterImage() {
		return $this->chapter_image;
    }
    
}
