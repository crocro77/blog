<?php

class Comment
{	
	private $id;
	private $post_id;
	private $comment;
	private $comment_date;
	private $author;
	private $signaled;

	public function __construct($value = []) {
		if(!empty($value)) {
			$this->hydrate($value);
		}
	}

	public function hydrate($data) {
		foreach($data as $key => $value) {
			$method = 'set'.ucfirst($key);
			if(method_exists([$this, $method])) {
				$this->$method($value);
			}
		}
	}

	// SETTERS 
	
	/**
	 * Permet d'assigner une valeur à l'attribut 'id'.
	 * @param int $id L'id
	 */
	public function setId($id) {
		if(is_int($id) AND $id > 0) {
			$this->id = $id;
		}
	}

	/**	
	 * Permet d'assigner une valeur à l'attribut 'post_id'.
	 * @param int $post_id L'id du chapter
	 */
	public function setPostId($post_id) {
		$this->post_id = (int) $post_id;
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'comment'.
	 * @param string $comment Le commentaire
	 */
	public function setComment($comment) {
		if(is_string($comment) AND !empty($comment)) {
			$this->comment = $comment;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'comment_date'.
	 * @param DateTime $comment_date La date de publication
	 */
	public function setCommentDate(DateTime $comment_date) {
		$this->comment_date = $comment_date;
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'author'.
	 * @param string $author L'auteur
	 */
	public function setAuthor($author) {
		if(is_string($author) AND !empty($author)) {
			$this->author = $author;
		}
	}
    
	/**
	 * Permet d'assigner une valeur à l'attribut 'signaled'.
	 * @param int $signaled Le signal
	 */
	public function setSignaled($signaled) {
		if(is_int($signaled) AND !empty($signaled)) {
			$this->signaled = $signaled;
		}
	}
	
	// GETTERS //
	
	/**
	 * Obtient l'id du commentaire.
	 * @return int L'id du commentaire
	 */
	public function getId() {
		return $this->id; 
	}

	/**
	 * Obtient l'id de l'chapter.
	 * @return int L'id de l'chapter
	 */
	public function getPostId() {
		return $this->post_id; 
    }
    
	/**
	 * Obtient le contenu du commentaire.
	 * @return string Le commentaire
	 */
	public function getComment() {
		return $this->comment; 
	}

	/**
	 * Obtient la date de publication du commentaire.
	 * @return DateTime Object La date de publication
	 */
	public function getCommentDate() {
		return $this->comment_date; 
	}

	/**
	 * Obtient l'auteur du commentaire.
	 * @return string L'auteur
	 */
	public function getAuthor() {
		return $this->author; 
    }
    
	/**
	 * Obtient la valeur de l'attribut 'Signaled'.
	 * @return int Le signalement
	 */
	public function getSignaled() {
		return $this->signaled; 
	}

}