<?php $title = "Billet simple pour l'Alaska - Jean Forteroche"; ?>

<?php ob_start(); ?>

<div class="container">
    <h2>Les chapitres</h2>
        <?php
        foreach ($chapters as $chapter) {
            ?>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h4><?= $chapter->title ?></h4>
                        <div class="row">
                            <div class="col s12 m6 l8">
                                <?= substr(nl2br($chapter->content), 0, 800) ?>...
                            </div>
                            <div class="col s12 m6 l4">
                                <img src="img/posts/<?= $chapter->chapter_image ?>" class="materialboxed responsive-img" alt="<?= $chapter->title ?>" />
                                <br />
                                <a class="btn light-blue waves-effect waves-light" href="index.php?page=postView&id=<?= $chapter->id ?>">Lire le chapitre complet</a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
        }
        ?>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>