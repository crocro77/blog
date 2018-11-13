<?php

class ViewHome
{
	private $listOfChapters;
	private $numberOfPages;
	private $currentPage;

	public function __construct($listOfChapters, $numberOfPages, $currentPage)
	{
		$this->listOfChapters = $listOfChapters;
		$this->numberOfPages = $numberOfPages;
		$this->currentPage = $currentPage;
	}
	
	// affiche le contenu de la vue.
	public function display()
	{
		?>
		<br />
		<div class="container">
			<div id="illustration">
				<img id="landscape" src="public/img/alaska_landscape.jpg" alt="alaska landscape">
			</div>
			<br />	
			<div class="row">
				<h1 id="site-title">Billet simple pour l'Alaska<br />Jean Forteroche</h1>
				<br />
				<h5 id="titleDetail">Découvrez ce roman passionnant avec de nouveaux chapitres ajoutés régulièrement !</h5>
				<br />
			</div>
			<ul class="pagination center">
				<?php
					for($i = 1; $i <= $this->numberOfPages; $i++) {
						if($i == $this->currentPage) { 
							echo "<li class='page-item'><a class='page-link'>$i</a></li>";
						} else {
							echo '<li class="waves-effect"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
						}
					}
				?>
			</ul>
			<br />
				<div id="anchor" class="row">
					<div class="col-xs-12">
						<?php
						if(empty($this->listOfChapters)) {
							echo '<div class="alert alert-danger">';
							echo '<p>Aucun chapitre n\'a été publié pour le moment. Patientez un peu, l\'auteur est en plein travail.</p>';
							echo '</div>';
							if(isset($_SESSION['username']) && $_SESSION['username'] == 'j.forteroche') {
								echo '<p><a class="btn btn-default" href="index.php?p=admin&amp;menu=write">Commencez ici</a></p>';
							} 
						} else {
							foreach($this->listOfChapters as $chapter) { ?>
								<div class="col l6 m6 s12">
									<div class="card">
									<div class="card-content">
										<h5 class="grey-text text-darken-2"><?= htmlspecialchars($chapter->getTitle()); ?></h5>
										<h6 class="grey-text">Le <?= $chapter->getDate()->format("d/m/Y"); ?> par <?= $chapter->getAuthor(); ?></h6>
									</div>
									<div class="card-image waves-effect waves-block waves-light">
										<a href="index.php?p=single&amp;id=<?= $chapter->getId(); ?>"><img src="public/img/<?= $chapter->getChapterImage(); ?>" alt="<?= htmlspecialchars($chapter->getTitle()); ?>"/></a>
									</div>
										<div class="card-content">
										<span class="card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
										<p><a href="index.php?p=single&amp;id=<?= $chapter->getId(); ?>">Voir le chapitre complet</a></p>
										</div>
										<div class="card-reveal">
										<span class="card-title grey-text text-darken-4"><?= htmlspecialchars($chapter->getTitle()); ?><i class="material-icons right">close</i></span>
											<p><?= substr($chapter->getContent(), 0, 400) . '...'; ?></p>
											</div>
										</div>
									</div>
							<?php
							}
						}
						?>
					</div>
				</div>
				<ul class="pagination center">
				<?php
					for($i = 1; $i <= $this->numberOfPages; $i++) {
						if($i == $this->currentPage) { 
							echo "<li class='page-item'><a class='page-link'>$i</a></li>";
						} else {
							echo '<li class="waves-effect"><a class="page-link" href="?page=' . $i . '#anchor">' . $i . '</a></li>';
						}
					}
				?>
			</ul>
		</div>
		<?php
	}
}