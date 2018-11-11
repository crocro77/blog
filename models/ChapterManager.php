<?php

class ChapterManager
{	

	// Attribut nécessaire à la connexion avec la base de données.
	private $db;

	/**
	 * Permet de se connecter à la base de données dès l'instanciation de l'objet.
	 * @param PDO Object $db La base de données
	 */
	public function __construct($db)
	{
		$this->db = $db;
	}

	/**
	 * Compte le nombre d'Chapters dans la base de données.
	 * @return int Le nombre d'Chapters
	 */
	public function count()
	{
		$result = $this->db->query('SELECT COUNT(*) FROM posts')->fetchColumn();
		return $result;
	}

	/**
	 * Ajoute un chapitre dans la base de données.
	 * @param chapter $chapter L'chapter (object)
	 */
	public function add(Chapter $chapter)
	{
		$req = $this->db->prepare('INSERT INTO posts(title, content, author, date) VALUES(:title, :content, :author, NOW())');
		$req->bindValue(':title', $chapter->getTitle());
		$req->bindValue(':content', $chapter->getContent());
		$req->bindValue(':author', $chapter->getAuthor());
		$req->execute();
	}

	/**
	 * Met à jour les valeurs d'un chapter.
	 * @param string $title Le titre
	 * @param string $author L'auteur
	 * @param string $content Le contenu
	 * @param int $id L'id
	 */
	public function update($title, $author, $content, $id)
	{
		$request = $this->db->prepare('UPDATE posts SET title = :title, author = :author, content = :content, date = NOW() WHERE id = :id');
		$request->bindValue(':title', $title);
		$request->bindValue(':author', $author);
		$request->bindValue(':content', $content);
		$request->bindValue(':id', (int) $id);
		$request->execute();
	}

	/**
	 * Obtient la liste des chapitres.
	 * @param int $firstArticle Le premier chapitre
	 * @param int $chaptersPerPage Le nombre de chapires par page
	 * @return Chapte objects La liste
	 */
	public function getList($firstChapter = -1, $chaptersPerPage = -1) 
	{
		$sql = 'SELECT * FROM posts ORDER BY id';
		
		// Vérification de la validité des données reçues.
		if($firstChapter != -1 OR $chaptersPerPage != -1)
		{
			$sql .= ' LIMIT ' . (int) $chaptersPerPage . ' OFFSET ' . (int) $firstChapter;
		}
		$request = $this->db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Chapter');
		$listOfChapters = $request->fetchAll();
		// On boucle sur la liste des chapitres afin d'instancier des objets DateTime pour date
		foreach($listOfChapters as $chapter)
		{
			$chapter->setDate(new DateTime($chapter->getDate()));
		}
		$request->closeCursor();
		return $listOfChapters;
	}
	
	/**
	 * Obtient un chapter unique (pour la vue Single)
	 * @param int $id L'id duchapter
	 * @return chapter Object chapter.
	 */
	public function getUnique($id)
	{
		$request = $this->db->prepare('SELECT * FROM posts WHERE id = :id');
		$request->bindValue(':id', (int) $id);
		$request->execute();
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Chapter');
		$chapter = $request->fetch();
		$chapter->setDate(new DateTime($chapter->getDate()));
		return $chapter;
	}

	/**
	 * Supprimer un chapter de la base de données.
	 */
	public function deleteChapter()
	{
		$chapterManager = new ChapterManager($this->db);
		$commentManager->deleteAllWithChapter($_POST['id']);
		$this->db->exec('DELETE FROM posts WHERE id = '. $_POST['id']);
	}

	/**
	 * Supprime tous les Chapters de la bdd
	 */
	public function deleteAll()
	{
		$result = $this->db->exec('TRUNCATE TABLE posts');
		return $result;
	}
}