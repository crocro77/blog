<?php

class ViewSingle
{
	private $chapterUnique;
	private $listOfComments;
	private $numberOfComments;

	public function __construct($chapterUnique, $listOfComments, $numberOfComments)
	{
		$this->chapterUnique = $chapterUnique;
		$this->listOfComments = $listOfComments;
		$this->numberOfComments = $numberOfComments;
    }
    
	// affiche le contenu de la vue.
	public function display()
	{   
		?>
        <br />
		<div class="container">
            <div id="illustration">
                <img id="landscape" src="public/img/alaska_landscape2.jpg" alt="alaska landscape">
            </div>
            <br />
            <div>
                <h1  id="site-title">Billet simple pour l'Alaska de Jean Forteroche</h1>
                <br />
                <p id="titleDetail"><a class="btn light-blue waves-effect" href="index.php">Retour à la page d'accueil</a></p>
            </div>
        </div>
        <div class="container">
            <h2 id="post-title" class="center"><?= htmlspecialchars($this->chapterUnique->getTitle()); ?></h2>
            <div class="row center">
                <img class="chapterUniqueImage" src="public/img/<?= $this->chapterUnique->getChapterImage() ?>" alt="<?= htmlspecialchars($this->chapterUnique->getTitle()); ?>" >
            </div>
            <h6 class="center">Par <?= htmlspecialchars($this->chapterUnique->getAuthor()); ?> le <?= $this->chapterUnique->getDate()->format('d/m/Y') ?></h6>
            <p><?= $this->chapterUnique->getContent(); ?></p>
            <hr>
            <h4>Commentaire(s)</h4>
            <?php
            if ($this->listOfComments != false) {
                foreach($this->listOfComments as $comment) {
                ?>
                <strong><?= htmlspecialchars($comment->getAuthor()); ?> (Le <?= date("d/m/Y", strtotime($comment->getCommentDate())) ?>) a dit :</strong><?php
                ?>
                <blockquote>
                    <p>
                        <?= htmlspecialchars($comment->getComment()); ?>
                        <?php
                        if(empty($comment->getSignaled())) { // Si l'attribut 'signaler' est vide, on affiche le lien pour signaler.
                        ?>
                        <a href="index.php?p=single&amp;id=<?= $this->chapterUnique->getId(); ?>&amp;action=signal&amp;commentId=<?= $comment->getId(); ?>"><small class="signal pull-right">Signaler</small></a>
                        <?php
                        // Sinon, on affiche un message d'alerte pour prévenir que le commentaire a été signalé.
                        } else {
                            echo '<em>Le commentaire a été signalé et est en attente de modération.</em>';
                        }
                        ?>
                    </p>
                </blockquote>
                <?php
                }
            } else {
                echo "Aucun commentaire n'a été publié, soyez le premier à réagir !";
            }   
            ?>
			<hr>
			<h4 id="poster-commentaire">Commenter</h4>
			<div class="write-comment">
                <?php
                if(isset($_SESSION['username'])) {
                    echo '<p>Vous postez un commentaire en tant que <strong>' . $_SESSION['username'] . '</strong></p>';
                }
                ?>
                <form class="form-horizontal" action="index.php?p=single&amp;id=<?= $this->chapterUnique->getId(); ?>#comments" method="post">
                    <?php
                    if(!isset($_SESSION['username'])) {
                    ?>
                    <div class="form-group">
                        <label for="author" class="col-sm-1 control-label">Pseudo </label>
                        <div class="col-sm-offset-1 col-sm-2">
                            <input type="text" name="author" class="form-control" />
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="comment" class="col-sm-1 control-label">Commentaire</label>
                        <div class="col-sm-offset-1 col-sm-10">
                            <textarea name="comment" class="materialize-textarea"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $this->chapterUnique->getId(); ?>">
                    <div class="col s12">
                        <button type="submit" name ="submit" class="btn light-blue waves-effect">Envoyer votre commentaire</button>
                    </div>
                </form>
        </div>
    <?php
    }
}