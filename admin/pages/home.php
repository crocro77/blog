<h3>Découvrez un roman passionnant mis à jour régulièrement !</h3>
<div class="row">
<?php 

$posts = get_posts();

foreach($posts as $chapter) {
?>

    <div class="col l6 m6 s12">
        <div class="card">
            <div class="card-content">
                <h5 class="grey-text text-darken-2"><?= $chapter->title ?></h5>
                <h6 class="grey-text">Le <?= $chapter->creation_date_fr ?> par <?= $chapter->author ?></h6>
            </div>
            <div class="card-image waves-effect waves-block waves-light">
                <img src="img/posts/<?= $chapter->chapter_image ?>" alt="<? $chapter->title ?>"/>
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
                <p><a href="index.php?page=post&id=<?= $chapter->id ?>">Voir le chapitre complet</a></p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4"><?= $chapter->title ?> <i class="material-icons right">close</i></span>
                <p><?= substr(nl2br($chapter->content), 0, 400); ?>...</p>
            </div>
        </div>
    </div>
    <?php
}

?>
</div>