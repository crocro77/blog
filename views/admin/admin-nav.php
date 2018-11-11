<br />
<div class="nav-content">
	<ul class="tabs center">
		<li class="tab" <?php if($this->selectedTab == 'dashboard') echo 'class="active"' ?>>
			<a title="Tableau de bord" href="index.php?p=admin&tab=dashboard"><i class="material-icons">dashboard</i></a>
		</li>
		<li class="tab" <?php if($this->selectedTab == 'list') echo 'class="active"' ?>>
			<a title="Mes chapitres" href="index.php?p=admin&tab=list"><i class="material-icons">view_list</i></a>
		</li>
		<li class="tab" <?php if($this->selectedTab == 'write')  echo 'class="active"' ?>>
			<a title="Ecrire" href="index.php?p=admin&tab=write"><i class="material-icons">edit</i></a>
		</li>
		<li class="tab" <?php if($this->selectedTab == 'comments') echo 'class="active"' ?>>
			<a title="Commentaires" href="index.php?p=admin&tab=comments"><i class="material-icons">comment</i></a>
		</li>
		<li class="tab" <?php if($this->selectedTab == 'settings') echo 'class="active"' ?>>
			<a title="Paramètres" href="index.php?p=admin&tab=settings"><i class="material-icons">build</i></a>
		</li>
	</ul>
</div>