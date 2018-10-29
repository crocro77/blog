<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<br />
<div id="illustration">
  <img id="landscape" src="public/img/alaska_landscape2.jpg" alt="alaska landscape">
</div>
<br />
<div>
<h1  id="title">Billet simple pour l'Alaska de Jean Forteroche</h1>
<br />
<p id="titleDetail"><a class="btn btn-primary" href="index.php">Retour à la liste des chapitres</a></p>
</div>
<div id="posts">
    <h3 id="postTitle">
        <?= htmlspecialchars($post['title']) ?>
        <br />
        <img src="public/img/<?= $post['chapter_image']; ?>" alt="chapter image">
        <br />
        <em>le <?= $post['creation_date_fr'] ?>  par <?= $post['author'] ?></em>
    </h3>
    <p id="chapterContent">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>
<br />
<div id="comments">
    <h2>Commentaires</h2>
    <?php
    while ($comment = $comments->fetch()) {
    ?>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <strong>Admin only - à voir plus tard</strong>
        <em><a class="btn btn-primary" href="index.php?action=edit&id=<?= $comment['id'] ?>&postId=<?= $post['id'] ?>">Editer</a></em>
        <em><a class="btn btn-primary" href="index.php?action=delete?id=<?= $comment['id'] ?>&postId=<?= $post['id'] ?>">Supprimer</a></em>
    <?php

    }
    ?>
</div>
<br />
<div id="addComments">
    <h2>Ajouter un commentaire</h2>
        <form action="index.php?action=addComment&id=<?= $post['id'] ?>" method="post">
            <div>
                <label for="author">Pseudo</label><br />
                <input type="text" id="author" name="author">
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea id="newComment" name="comment"></textarea>
            </div>
            <div>
                <input class="btn btn-primary" type="submit">
            </div>
        </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontoffice/template.php'); ?> 