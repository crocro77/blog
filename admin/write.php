<?php 
if(isset($_GET['action']) AND $_GET['action'] == 'edit' AND isset($_GET['id'])) {
	echo '<div class="page-header">';
	echo '<h3>Mettre à jour le chapitre</h3>';
	echo '</div>';
} else {
	echo '<div class="page-header">';
	echo '<h3>Nouveau chapitre</h3>';
	echo '</div>';
}

// Si l'on n'est pas en train d'éditer un article. 
if(!isset($_GET['action'])) {
	echo '<p>Vous pouvez rédiger un nouveau chapitre. Il apparaîtra non seulement sur la page d\'accueil, mais aussi dans votre liste de chapitres.</p>';
}
if(isset($_SESSION['flash'])) {
	include('includes/flash-msg.php');
}
?>
<form action="" method="post">
	<div class="form-group">
		<label for="title">Titre </label>
		<input type="text" name="title" class="form-control" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $this->chapter->getTitle(); ?>" />
	</div>
	<div class="form-group">
		<label for="author">Auteur </label>
		<input type="text" name="author" class="form-control" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $this->chapter->getAuthor(); ?>" />
	</div>
	<div class="form-group">
		<label for="content">Contenu </label>
		<textarea name="content" class="form-control"><?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $this->chapter->getContent(); ?></textarea>
	</div>
	<div class="col s12">
        <div class="btn light-blue waves-effect waves-light input-field file-field col s3">
                <span>Image de l'article</span>
                <input type="file" name="image" class="col s12"/>
        </div>
    </div>	

	<?php
	// Si on édite un article, le bouton d'envoi devient 'Mettre à jour'.
	if(isset($_GET['action']) AND $_GET['action'] == 'edit') {
		?>
		<input type="hidden" name="id" value="<?= $this->chapter->getId(); ?>" />
		<button type="submit" class="btn btn-warning">Mettre à jour</button>
		<?php
	}
	// Sinon, le bouton d'envoi permet de publier un article.
	else {
		?>
		<button type="submit" class="btn btn-publish">Publier</button>
		<?php
	}
	?>
</form>