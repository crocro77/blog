<?php

class ViewAdmin
{
	// Attributs nécessaires à la vue.
	private $listOfChapters,
			$selectedTab,
			$chapter,
			$signaledComments,
			$totalChapters,
			$totalComments,
			$listOfComments,
			$totalSignaledComments;

	public function __construct($listOfChapters, $selectedTab, $chapter, $signaledComments, $totalChapters, $totalComments, $listOfComments, $totalSignaledComments) {
		$this->listOfChapters = $listOfChapters;
		$this->selectedTab = $selectedTab;
		$this->chapter = $chapter;
		$this->signaledComments = $signaledComments;
		$this->totalChapters = $totalChapters;
		$this->totalComments = $totalComments;
		$this->listOfComments = $listOfComments;
		$this->totalSignaledComments = $totalSignaledComments;
	}

	// affiche le contenu de la vue.
	public function display() {
		?>
		<div class="container">
			
			<?php
				include('admin/admin-nav.php');
				// Le tableau de bord si 'selectedTab' vaut 'dashboard'.
				if($this->selectedTab == 'dashboard') {
					include('admin/dashboard.php');
				}
				// La liste des Chapters.
				elseif($this->selectedTab == 'list') {
					include('admin/list-chapters.php');
				}
				// Le formulaire d'ajout ou d'édition de chapter.
				elseif($this->selectedTab == 'write') {
					include('admin/write.php');
				}
				// La liste des commentaires.
				elseif($this->selectedTab == 'comments') {
					include('admin/comments.php');
				}
				// Les réglages
				elseif($this->selectedTab == 'settings') {
					include('admin/settings.php');
				}
			?>
		</div>
		<?php
	}
}