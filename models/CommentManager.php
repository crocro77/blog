<?php

class CommentManager extends ObjectModel
{	
	/**
	 * Ajoute un commentaire en base de données.
	 * @param Comment $comment Le commentaire
	 */
	public function add(Comment $comment) {
		$req = $this->db->prepare('INSERT INTO comments (post_id, author, comment, comment_date) VALUES(:post_id, :author, :comment, NOW())');
		$req->bindValue(':post_id', $comment->getPostId());
		$req->bindValue(':author', $comment->getAuthor());
		$req->bindValue(':comment', $comment->getComment());
		$req->execute();
	}

	/**
	 * Obtient un commentaire spécifique.
	 * @param int $id L'id du commentaire
	 * @return Comment Object Le commentaire.
	 */
	public function getSpecificComment($id) {
		$request = $this->db->prepare('SELECT * FROM comments WHERE id = :id');
		$request->bindValue(':id', (int) $id);
		$request->execute();
		$request->setFetchMode(PDO::FETCH_CLASS, "Comment");
		$comment = $request->fetch();
		$request->closeCursor();
		return $comment;
	}

	/**
	 * Obtient tous les commentaires, triés par id du chapitre et date de publication.
	 * @return Comment objet Les commentaires.
	 */
	public function getAllComments() {
		$result = $this->db->query("SELECT comments.id, comments.author, comments.comment_date, comments.post_id, comments.comment, posts.title FROM comments JOIN posts ON comments.post_id = posts.id WHERE comments.seen = '0' ORDER BY comments.post_id, comments.comment_date ASC");
		$listComments = $result->fetchAll(PDO::FETCH_CLASS, "Comment");
		foreach($listComments as $comment) {
			$comment->setCommentDate(new DateTime($comment->getCommentDate()));
		}
		return $listComments;
	}

	/**
	 * Obtient les commentaires d'un chapitre spécifique
	 * @param id $chapterId L'id du chapitre
	 * @return Comment objet Les commentaires.
	 */
	public function getComments($post_id) {
		$request = $this->db->prepare('SELECT * FROM comments WHERE post_id = :post_id ORDER BY comment_date DESC');
		$request->bindValue(':post_id', $post_id);
		$request->execute();
		$listComments = $request->fetchAll(PDO::FETCH_CLASS, "Comment");
		$request->closeCursor();
		return $listComments;
	}

	/**
	 * Signaler un commentaire
	 * @param $comment  The comment
	 */
	public function signal($comment) {
		$req = $this->db->prepare('UPDATE comments SET signaled = 1  WHERE id = :id ');
		$req->bindValue(':id', (int) $comment->getId());
		$req->execute();
	}

	/**
	 * Valider un commentaire
	 * @param int $commentId The comment identifier
	 */
	public function validateComment($commentId) {
		$req = $this->db->prepare('UPDATE comments SET signaled = 0, seen = 1 WHERE id = :id');
		$req->bindValue(':id', (int) $commentId);
		$req->execute();
	}

	/**
	 * Indiqué comme vu un commentaire
	 * @param int $commentId 
	 */
	public function seenComment($commentId) {
		$req = $this->db->prepare('UPDATE comments SET seen = 1 WHERE id = :id');
		$req->bindValue(':id', (int) $commentId);
		$req->execute();
	}

	/**
	 * obtenir le commentaire signalé
	 * @return le commentaire signalé.
	 */
	public function getSignaledComments() {
		$result = $this->db->query('SELECT * FROM comments WHERE signaled > 0 ORDER BY signaled DESC');
		$signaledComments = $result->fetchAll(PDO::FETCH_CLASS, "Comment");
		foreach($signaledComments as $comment) {
			$comment->setCommentDate(new DateTime($comment->getCommentDate()));
		}
		return $signaledComments;
	}

	/**
	 * supprime un commentaire
	 * @param int $id l'identifiant
	 */
	public function deleteComment($commentId) {
		$req = $this->db->prepare('DELETE FROM comments WHERE id = :id');
		$req->bindValue(':id', $commentId);
		$req->execute();
	}
}