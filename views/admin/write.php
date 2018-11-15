<?php 
if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
	echo '<div class="page-header">';
	echo '<h3>Mettre à jour le chapitre</h3>';
	echo '</div>';
} elseif (isset($_GET['action']) && $_GET['action'] == 'write' && isset($_GET['id'])) {
	echo '<div class="page-header">';
	echo '<h3>Nouveau chapitre</h3>';
	echo '</div>';
}
// Si l'on n'est pas en train d'éditer un article. 
if(!isset($_GET['action'])) {
	echo '<p>Vous pouvez rédiger dès à présent un nouveau chapitre.</p>';
}
if(isset($_SESSION['flash'])) {
	include('includes/flash-msg.php');
}
?>
<form action="" method="post">
	<div class="form-group">
		<label for="title">Titre </label>
		<input type="text" name="title" class="form-control" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $chapter->getTitle(); ?>" />
	</div>
	<div class="form-group">
		<label for="author">Auteur </label>
		<input type="text" name="author" class="form-control" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $chapter->getAuthor(); ?>" />
	</div>
	<div class="form-group">
		<label for="content">Contenu </label>
		<textarea name="content" class="form-control"><?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $chapter->getContent(); ?></textarea>
	</div>
	<div class="col s12">
        <div class="btn light-blue waves-effect waves-light input-field file-field col s3">
                <span>Image de l'article</span>
                <input type="file" name="image" class="col s12"/>
        </div>
    </div>	
	<?php
	// Si on édite un article, le bouton d'envoi devient 'Mettre à jour'.
	if(isset($_GET['action']) && $_GET['action'] == 'edit') {
		?>
		<input type="hidden" name="id" value="<?= $chapter->getId(); ?>" />
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
<script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=c851wd1npuo4c59ed6f7fp6doripcdhfdi1ltt9hpr29wt3x"></script>
<script>tinymce.init({
	selector: 'textarea',
	height: 500,
	menubar: false,
    plugins: [
        'advlist autolink lists charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media save table contextmenu paste code'
    ],
    toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
    content_css: '//www.tinymce.com/css/codepen.min.css'
    });
</script>