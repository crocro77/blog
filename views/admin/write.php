<?php 
// Si l'on édite un chapitre
if(isset($action) && $action == 'edit')  {
	echo '<h5>Mettre à jour le chapitre</h5>';
}

// Si l'on n'est pas en train d'éditer un chapitre. 
if(!isset($action)) {
	echo '<p>Vous pouvez rédiger dès à présent un nouveau chapitre.</p>';
}

if(isset($_SESSION['flash'])) {
	include('includes/flash-msg.php');
}

?>

<?php
$repopulateTitle = '';
$repopulateContent = '';
if(isset($_POST['title']) || isset($_POST['content']))
{
	$repopulateTitle = $_POST['title'];
	$repopulateContent = $_POST['content'];
}
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Titre </label>
		<input type="text" name="title" class="form-control" value="<?php if(isset($action) && $action == 'edit') echo $chapter->getTitle(); else echo $repopulateTitle ?>" />
	</div>
	<div class="form-group">
		<label for="author">Auteur </label>
		<input type="text" name="author" class="form-control" value="<?php if(isset($action) && $action == 'edit') echo $chapter->getAuthor(); else echo "Jean Forteroche" ?>" />
	</div>
	<div class="form-group">
		<label for="content">Contenu </label>
		<textarea name="content" class="form-control"><?php if(isset($action) && $action == 'edit') echo $chapter->getContent(); else echo $repopulateContent ?></textarea>
	</div>
	<br />
	<img id="output_image" width="25%" height="25%"/>
	<div class="col s12">
        <div class="btn light-blue waves-effect waves-light input-field file-field col s3">
			<input type="file" name="file" onchange="preview_image(event)"/>
    		<input type="submit" value="Image d'illustration du chapitre" name="submit">
        </div>
    </div>

	<?php
	// Si on édite un chapitre, le bouton d'envoi devient 'Mettre à jour'.
	if(isset($action) && $action == 'edit') {
		?>
		<input type="hidden" name="id" value="<?= $chapter->getId(); ?>" />
		<button type="submit" class="btn btn-warning">Mettre à jour</button>
		<?php
	}
	// Sinon, le bouton d'envoi permet de publier un chapitre.
	else {
		?>
		<button type="submit" class="btn btn-publish">Publier</button>
		<?php
	}
	?>
</form>
<!-- On appelle la librairie TinyMCE pour la page Ecriture/Edition -->
<script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=c851wd1npuo4c59ed6f7fp6doripcdhfdi1ltt9hpr29wt3x"></script>
<script type="text/javascript" src="public/js/tinymce.js"></script>

<script type="text/javascript" src="public/js/preview-image.js"></script>