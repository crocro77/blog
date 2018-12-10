<?php

class Chapter extends ObjectModel
{
	private $id;
	private $title;
	private $content;
	private $author;
	private $date;
    private $chapter_image;

	public function __construct($value = [])
	{
		parent::__construct();
		$this->tableName = 'posts';
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

	/**
	 * Obtient la liste des chapitres.
	 * @param int $firstArticle Le premier chapitre
	 * @param int $chaptersPerPage Le nombre de chapitres par page
	 * @return Chapter objects La liste
	 */
	public static function getList($firstChapter = -1, $chaptersPerPage = -1) 
	{
		$sql = 'SELECT * FROM posts ORDER BY id';
		
		// Vérification de la validité des données reçues.
		if($firstChapter != -1 OR $chaptersPerPage != -1)
		{
			$sql .= ' LIMIT ' . (int) $chaptersPerPage . ' OFFSET ' . (int) $firstChapter;
		}
		$db = Database::getDBConnection();
		$request = $db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Chapter');
		$listOfChapters = $request->fetchAll();
		
		// On boucle sur la liste des chapitres afin d'instancier des objets Date pour date
		foreach($listOfChapters as $chapter)
		{
			$chapter->setDate(new DateTime($chapter->getDate()));
		}
		$request->closeCursor();
		return $listOfChapters;
	}

	/**
	 * Obtient un chapitre unique (pour la vue Single)
	 * @param int $id L'id du chapitre
	 * @return chapter l'objet chapitre
	 */
	public static function getUnique($id)
	{
		$db = Database::getDBConnection();
		$request = $db->prepare('SELECT * FROM posts WHERE id = :id');
		$request->bindValue(':id', (int) $id);
		$request->execute();
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Chapter');
		$chapter = $request->fetch();
		if($chapter === false) {
			header("Location:index.php");
		}
		$chapter->setDate(new DateTime($chapter->getDate()));
		return $chapter;
	}

	/**
	 * Ajoute un chapitre dans la base de données.
	 * @param chapter $chapter L'objet chapitre
	 */
	public static function add(Chapter $chapter)
	{
		$db = Database::getDBConnection();
		$req = $db->prepare('INSERT INTO posts(title, content, author, chapter_image, date) VALUES(:title, :content, :author, :chapter_image, NOW())');
		$req->bindValue(':title', $chapter->getTitle());
		$req->bindValue(':content', $chapter->getContent());
		$req->bindValue(':author', $chapter->getAuthor());
		$req->bindValue(':chapter_image', $chapter->getChapterImage() ? $chapter->getChapterImage() : 'post.png');
		$req->execute();
	}

	/**
	 * Met à jour les valeurs d'un chapitre.
	 * @param string $title Le titre
	 * @param string $author L'auteur
	 * @param string $content Le contenu
	 * @param int $id L'id
	 */
	public static function update($title, $author, $content, $id)
	{
		$db = Database::getDBConnection();
		$request = $db->prepare('UPDATE posts SET title = :title, author = :author, content = :content WHERE id = :id');
		$request->bindValue(':title', $title);
		$request->bindValue(':author', $author);
		$request->bindValue(':content', $content);
		$request->bindValue(':id', (int) $id);
		$request->execute();
	}

	/**
	 * Met à jour l'image d'un chapitre.
	 * @param string $chapter_image L'image
	 */
	public static function updateImage($chapter_image, $id)
	{
		$db = Database::getDBConnection();
		$request = $db->prepare('UPDATE posts SET chapter_image = :chapter_image WHERE id = :id');
		$request->bindValue(':chapter_image', $chapter_image);
		$request->bindValue(':id', (int) $id);
		$request->execute();
	}
	
	/**
	 * Supprime un chapitre de la bdd
	 */
	public static function deleteChapter()
	{
		$db = Database::getDBConnection();
		$db->exec('DELETE FROM posts WHERE id = '. $_POST['id']);
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