<?php
/**
 * Classe pour le formulaire de soumission d'article dans la page d'administration
 */
class AdminForm
{
	private $surround = 'form-group';

	/**
	 * Se charge d'entourer les champs d'une div ayant pour classe le contenu de l'attribut 'surround'.
	 * @param html $html Le champ devant être entouré
	 * @return ligne de code HTML
	 */
	public function surround($html)
	{
		return "<div class=\"{$this->surround}\">{$html}</div>";
	}

	/**
	 * Crée un champ de type 'text' pour le titre de l'article.
	 */
	public function titleField()
	{
		return $this->surround('<label for="title">Titre </label><input type="text" name="title" class="form-control" value="' . isset($_GET['action']) AND $_GET['action'] == 'edit' ? 
				$chapterManager->getTitle() : null . '">');
	}

	/**
	 * Crée un champ de type 'text' pour l'auteur de l'article.
	 */
	public function authorField()
	{
		return $this->surround('<label for="author">Auteur </label><input type="text" name="author" class="form-control" value="' . isset($_GET['action']) AND $_GET['action'] == 'edit' ? 
				$chapterManager->getAuthor() : null . '">');
	}

	/**
	 * Crée un textarea pour le contenu de l'article.
	 */
	public function contentField()
	{
		return $this->surround('<label for="content">Contenu </label><textarea name="content" class="form-control">' .isset($_GET['action']) AND $_GET['action'] == 'edit' ? 
				$chapterManager->getContent() : null . '</textarea>');
	}

	/**
	 * Crée un bouton de type 'submit' pour soumettre le formulaire.
	 */
	public function submit()
	{
		return '<button type="submit" class="btn btn-primary">Publier</button>';
	}

}