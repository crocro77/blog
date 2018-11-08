<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<br />
<div class="container">
  <div id="illustration">
    <img id="landscape" src="public/img/alaska_landscape.jpg" alt="alaska landscape">
  </div>
  <br />
  <div class="row">
  <h1 id="site-title">Billet simple pour l'Alaska<br />Jean Forteroche</h1>
  <br />
  <h5 id="titleDetail">Découvrez ce roman passionnant avec de nouveaux chapitres ajoutés régulièrement !</h5>
  <br />
  <ul class="pagination center">
    <?php
    for ($i = 1; $i <= $pageNumber; $i++) {
      if ($i == $currentPage) {
        echo "<li class='page-item'><a class='page-link'>$i</a></li>";
      } else {
        echo "<li class='waves-effect'><a class='page-link' href=\"index.php?p=$i\">$i</a></li>";
      }
    }
    ?>
  </ul>
  <br />
  <?php
  while ($data = $posts->fetch()) {
    ?>
  <div class="col l6 m6 s12">
    <div class="card">
      <div class="card-content">
        <h5 class="grey-text text-darken-2"><?= htmlspecialchars($data['title']) ?></h5>
        <h6 class="grey-text">Le <?= $data['creation_date_fr'] ?> par <?= $data['author'] ?></h6>
      </div>
      <div class="card-image waves-effect waves-block waves-light">
        <img src="public/img/<?= $data['chapter_image']; ?>" alt="<? $chapter->title ?>"/>
      </div>
        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
          <p><a href="index.php?action=post&id=<?= $data['id'] ?>">Voir le chapitre complet</a></p>
        </div>
        <div class="card-reveal">
          <span class="card-title grey-text text-darken-4"><?= $data['title'] ?> <i class="material-icons right">close</i></span>
            <p><?= substr(nl2br($data['content']), 0, 400) ?>;...</p>
            </div>
        </div>
    </div>
  <?php
}
?>
  </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
