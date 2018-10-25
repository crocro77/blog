<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<div id="illustration">
  <img id="landscape" src="public/img/alaska_landscape.jpg" alt="alaska landscape">
</div>
<div id="title">
<h1>Billet simple pour l'Alaska de Jean Forteroche</h1>
<p>Découvrez ce roman passionnant avec de nouveaux chapitres ajoutés régulièrement !</p>
</div>
<?php
while ($data = $posts->fetch())
{
?>
  <div id="posts">
    <h3 id="paragraph">
      <?= htmlspecialchars($data['title']) ?>
      <em> - Ecrit le <?= $data['date_creation_fr'] ?> par <?= $data['author'] ?></em>
    </h3>
    <p>
      <?= nl2br(htmlspecialchars($data['content'])) ?>
      <br />
    </p>
    <em><a class="commentButton" id="button" href="post.php?id=<?= $data['id'] ?>">Commentaires</a></em>
  </div>
<?php
}
$posts->closeCursor();
?>
<div id="createPost">
<strong>Admin only - à voir plus tard</strong>
<h2>Ajouter un chapitre</h2>
  <form method="post" action="create.php">
    Titre :<input type="text" name="title">
    <br />
    Contenu :<br/>
    <textarea id="newPost" name="content"></textarea>
    <br />
    <input id="button" type="submit" value="Valider">
  </form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>

