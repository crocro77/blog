<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<div id="illustration">
  <img id="landscape" src="public/img/alaska_landscape.jpg" alt="alaska landscape">
</div>
<div id="title">
<h1>Billet pour l'Alaska de Jean Forteroche</h1>
<p>Découvrez ce roman passionnant avec de nouveaux chapitres ajoutés régulièrement !</p>
</div>
<?php
while ($data = $posts->fetch())
{
?>
  <div id="posts">
    <h3>
      <?= htmlspecialchars($data['title']) ?>
      <em> - Ecrit le <?= $data['date_creation_fr'] ?> par <?= $data['author'] ?></em>
    </h3>
    <p>
      <?= nl2br(htmlspecialchars($data['content'])) ?>
      <br />
      <em><a href="post.php?id=<?= $data['id'] ?>">Commentaires</a></em>
    </p>
  </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>

