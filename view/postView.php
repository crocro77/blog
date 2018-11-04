<?php $title = "Billet simple pour l'Alaska - Jean Forteroche"; ?>

<?php ob_start(); ?>
</div>
        
<div class="parallax-container">
    <div class="parallax">
        <img src="img/posts/<?= $post->chapter_image ?>" alt="<?= $post->title ?>"/>
    </div>
</div>

<div class="container">
    <h2 id="post-title"><?= $post->title ?></h2>
    <h6>Par <?= $post->author ?> le <?= $post->creation_date_fr ?></h6>
    <p><?= nl2br($post->content); ?></p>

    <hr>
    <h4>Commentaires</h4>
        <?php
            if ($responses != false) {
                foreach ($responses as $response) {
                    ?>
                    <strong><?= $response->author ?> (<?= date("d/m/Y", strtotime($response->comment_date)) ?>) a dit :</strong>
                    <blockquote>
                    <p><?= nl2br($response->comment); ?></p>
                    </blockquote>
                    <?php

                }
            } else echo "Aucun commentaire n'a été publié, soyez le premier à réagir !"
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
                    post_comment($name, $email, $comment);
                    ?>
                        <script>
                            window.location.replace("index.php?page=post&id=<?= $_GET['id'] ?>")
                        </script>
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

<?php require('template.php'); ?>