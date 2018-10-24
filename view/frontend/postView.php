<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<div id="illustration">
  <img id="landscape" src="public/img/alaska_landscape.jpg" alt="alaska landscape">
</div>
<div id="title">
<h1>Billet simple pour l'Alaska de Jean Forteroche</h1>
<p><a id="button" href="index.php">Retour à la liste des chapitres</a></p>
</div>
<div id="posts">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['date_creation_fr'] ?></em>
    </h3>
    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>
<div id="comments">
    <h2>Commentaires</h2>
    <?php
    while ($comment = $comments->fetch()) {
    ?>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <em><a id="button" href="index.php?action=edit&amp;id=<?= $comment['id'] ?>&amp;postID=<?= $post['id'] ?>">Editer</a></em>
        <em><a id="button" href="*">Supprimer</a></em>
    <?php

    }
    ?>
</div>
<div id="addComments">
    <h2>Ajouter un commentaire</h2>
        <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
            <div>
                <label for="author">Pseudo</label><br />
                <input type="text" id="author" name="author" />
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea id="comment" name="comment"></textarea>
            </div>
            <div>
                <input id="button" type="submit" />
            </div>
        </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>