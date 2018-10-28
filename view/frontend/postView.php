<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<div id="illustration">
  <img id="landscape" src="public/img/alaska_landscape2.jpg" alt="alaska landscape">
</div>
<div>
<h1  id="title">Billet simple pour l'Alaska de Jean Forteroche</h1>
<p id="titleDetail"><a id="button" href="index.php">Retour à la liste des chapitres</a></p>
</div>
<div id="posts">
    <h3 id="postTitle">
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
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
        <em><a id="button" href="index.php?action=edit&id=<?= $comment['id'] ?>&postId=<?= $post['id'] ?>">Editer</a></em>
        <em><a id="button" href="index.php?action=delete?id=<?= $comment['id'] ?>&postId=<?= $post['id'] ?>">Supprimer</a></em>
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
                <input type="text" id="author" name="author" />
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea id="newComment" name="comment"></textarea>
            </div>
            <div>
                <input id="button" type="submit" />
            </div>
        </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?> 