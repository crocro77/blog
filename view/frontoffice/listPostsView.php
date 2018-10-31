<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<br />
<div id="illustration">
  <img id="landscape" src="public/img/alaska_landscape.jpg" alt="alaska landscape">
</div>
<br />
<div>
<h1 id="title">Billet simple pour l'Alaska de Jean Forteroche</h1>
<br />
<p id="titleDetail">Découvrez ce roman passionnant avec de nouveaux chapitres ajoutés régulièrement !</p>
</div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
  <?php
  for ($i = 1; $i <= $pageNumber; $i++) {
    if ($i == $currentPage) {
      echo "<li class='page-item'><a class='page-link'>$i</a></li>";
    } else {
      echo "<li class='page-item'><a class='page-link' href=\"index.php?p=$i\">$i</a></li>";
    }
  }
  ?>
  </ul>
</nav>
<?php
while ($data = $posts->fetch()) {
?>
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="public/img/<?= $data['chapter_image']; ?>" alt="chapter image">
    <div class="card-body">
      <h5 class="card-title">
        <?= htmlspecialchars($data['title']) ?>
        <em> - Ecrit le <?= $data['creation_date_fr'] ?> par <?= $data['author'] ?></em>
      </h5>
      <p class="card-text">
        <?= nl2br(htmlspecialchars($data['content'])) ?>;
        <br />
      </p>
      <a href="index.php?action=post&id=<?= $data['id'] ?>" class="btn btn-primary">Commentaires</a>
    </div>
</div>
<br />
<?php

}
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontoffice/template.php'); ?>
