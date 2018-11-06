<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<h2>Listing des chapitres</h2>
<hr/>

<?php

$posts = get_posts();
foreach($posts as $post){
    ?>
    <div class="row">
        <div class="col s12">
            <h4><?= $post->title ?><?php echo ($post->posted == "0") ? "<i class='material-icons'>lock</i>" : "" ?></h4>

            <div class="row">
                <div class="col s12 m6 l8">
                    <?= substr(nl2br($post->content), 0, 800) ?>...
                </div>
                <div class="col s12 m6 l4">
                    <img src="../Public/img/posts/<?= $post->chapter_image ?>" class="materialboxed responsive-img" alt="<?= $post->title ?>"/>
                    <br/><br/>
                    <a class="btn light-blue waves-effect waves-light" href="index.php?page=post&id=<?= $post->id ?>">Voir le chapitre complet</a>
                </div>
            </div>
        </div>
    </div>

    <?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('view/backtemplate.php'); ?>