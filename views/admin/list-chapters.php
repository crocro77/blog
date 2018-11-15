<h2 id="to-the-top">Liste des chapitres</h2>
<hr/>
<?php
if(empty($listOfchapters)) {
	echo '<p>Vous n\'avez pas encore publié d\'article. <a href="index.php?p=admin&amp;menu=write">Commencez ici</a></p>';
} else {
    foreach($listOfchapters as $chapter){
        ?>
        <div class="row">
            <div class="col s12">
                <h4 id="post-title"><?= htmlspecialchars($chapter->getTitle()); ?></h4>
                <p>
                    <small>Rédigé le <?= $chapter->getDate()->format('d/m/Y à H:i'); ?></small>
                </p>
                <div class="row">
                    <div class="col s12 m6 l8">
                    <?= substr($chapter->getContent(), 0, 1000) . '...'; ?>...
                    </div>
                    <div class="col s12 m6 l4 center">
                        <img src="public/img/<?= $chapter->getChapterImage() ?>" class="responsive-img" alt="<?= htmlspecialchars($chapter->getTitle()); ?>"/>
                        <br/><br/>
                        <a class="btn light-blue waves-effect waves-light" href="index.php?p=single&id=<?= $chapter->getId(); ?>">Voir le chapitre complet</a>
                        <br/><br/>
                        <a class="btn light-blue waves-effect waves-light" href="index.php?p=admin&tab=write&action=edit&id=<?= $chapter->getId(); ?>">Éditer le chapitre</a>
                        <br/><br/>
                        <form method="post" role="form" action="index.php?p=admin&menu=list&action=delete&id=<?= $chapter->getId(); ?>">
                            <input type="hidden" name="id" value="<?= $chapter->getId(); ?>">
                            <input type="submit" value="Supprimer le chapitre" class="btn btn-danger">
                        </form>
                    </div>
                </div>
                <hr/>
            </div>
        </div>
    <?php
    }
}
?>
<a href="#to-the-top" title="Retour en haut" class="right"><i class="material-icons">arrow_upward</i></a>