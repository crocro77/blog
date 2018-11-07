<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<br />
<div class="container">
<div id="illustration">
  <img id="landscape" src="public/img/alaska_landscape2.jpg" alt="alaska landscape">
</div>
<br />
<div>
<h1  id="site-title">Billet simple pour l'Alaska de Jean Forteroche</h1>
<br />
<p id="titleDetail"><a class="btn light-blue waves-effect" href="index.php">Retour à la liste des chapitres</a></p>
</div>
</div>
        
<div class="container">
    <h2 id="post-title" class="center"><?= htmlspecialchars($post['title']) ?></h2>
    <h6 class="center">Par <?= $post['author'] ?> le <?= $post['creation_date_fr'] ?></h6>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

    <hr>
    <h4>Commentaires</h4>
        <?php
        if ($comments != false) {
            foreach ($comments as $comment) {
                ?>
                    <strong><?= htmlspecialchars($comment->author) ?> (<?= date("d/m/Y", strtotime($comment->comment_date)) ?>) a dit :</strong>
                    <blockquote>
                    <p><?= nl2br(htmlspecialchars($comment->comment)) ?></p>
                    </blockquote>
                <?php
            }
        } else {
            echo "Aucun commentaire n'a été publié, soyez le premier à réagir !";
        }
        ?>

    <h4>Commenter</h4>
        <?php
        if (isset($_POST['submit'])) {
            $name = htmlspecialchars(trim($_POST['name']));
            $email = htmlspecialchars(trim($_POST['email']));
            $comment = htmlspecialchars(trim($_POST['comment']));
            $error = [];

            if (empty($name) || empty($email) || empty($comment)) {
                $errors['empty'] = "Tous les champs n'ont pas été remplis";
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "L'adresse email n'est pas valide";
                }
            }

            if (!empty($errors)) {
                ?>
                        <div class="card red">
                            <div class="card-content white-text">
                                <?php
                                foreach ($errors as $error) {
                                    echo $error . "<br />";
                                }
                                ?>
                            </div>
                        </div>
                    <?php 
                } else {
                    add_comment($name,$email,$comment);
                    ?>
                <?php
                }
            }
            ?>

    <form method="post">
        <div class="row">
            <div class="input-field col s12 m6 l6">
                <input type="text" name="name" id="name" />
                <label for="name">Nom</label>
            </div>
            <div class="input-field col s12 m6 l6">
                <input type="email" name="email" id="email" />
                <label for="name">Adresse email</label>
            </div>
            </div>
            <div class="input-field col s12 m12 l12">
                <textarea name="comment" id="comment" class="materialize-textarea"></textarea>
                <label for="comment">Commentaire</label>
            </div>
            <div class="col s12">
                <button type="submit" name="submit" class="btn light-blue waves-effect">Envoyer votre commentaire</button>
            </div>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?> 