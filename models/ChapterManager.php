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
	 * Compte le nombre de chapitres dans la base de données.
	 * @return int Le nombre de chapitres
	 */
	public function count()
	{
		$result = $this->db->query('SELECT COUNT(*) FROM posts')->fetchColumn();
		return $result;
	}

	/**
	 * Ajoute un chapitre dans la base de données.
	 * @param chapter $chapter L'objet chapitre
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
	 * Met à jour les valeurs d'un chapitre.
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
	 * @param int $chaptersPerPage Le nombre de chapitres par page
	 * @return Chapter objects La liste
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
	 * Supprime un chapitre de la bdd
	 */
	public function deleteChapter()
	{
		$chapterManager = new ChapterManager($this->db);
		$commentManager->deleteAllWithChapter($_POST['id']);
		$this->db->exec('DELETE FROM posts WHERE id = '. $_POST['id']);
	}

	/**
	 * Supprime tous les chapitres de la bdd
	 */
	public function deleteAll()
	{
		$result = $this->db->exec('TRUNCATE TABLE posts');
		return $result;
	}
}