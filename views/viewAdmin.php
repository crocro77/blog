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
				//  Le tableau de bord si 'selectedTab' vaut 'list'.
				elseif($this->selectedTab == 'list') {
					include('admin/list-chapters.php');
				}
				//  Le tableau de bord si 'selectedTab' vaut 'write'.
				elseif($this->selectedTab == 'write') {
					include('admin/write.php');
				}
				//  Le tableau de bord si 'selectedTab' vaut 'comments'.
				elseif($this->selectedTab == 'comments') {
					include('admin/comments.php');
				}
				//  Le tableau de bord si 'selectedTab' vaut 'settings'.
				elseif($this->selectedTab == 'settings') {
					include('admin/settings.php');
				}
			?>
		</div>
		<?php
	}
}