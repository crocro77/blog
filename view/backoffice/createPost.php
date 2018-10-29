<!-- A FAIRE -->
<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<div id="createPost">
<h2>Ajouter un chapitre</h2>
  <form method="post" action="">
    Titre :<input type="text" name="title">
    <br />
    Contenu :<br />
    <textarea id="newPost" name="content"></textarea>
    <br />
    <input id="button" type="submit" value="Valider">
  </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>