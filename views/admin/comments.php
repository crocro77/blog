<div class="page-header">
	<h3>Commentaire(s)</h3>
</div>
<?php
if($this->signaledComments) echo '<p id="flash" class="center"><i class="material-icons">warning</i>&nbspUn ou plusieurs commentaire(s) signalé(s) : Action requise !</p>';
if (empty($this->listOfComments)) {
	echo '<p>Aucun commentaire n\'a été posté pour le moment.</p>';
} else { ?>
	<table class="table">
		<thead>
			<th>Chapitre</th>
			<th>Commentaire</th>
			<th>Auteur</th>
			<th>Action</th>
		</thead>
		<tbody>
			<?php
		foreach ($this->listOfComments as $comment) { ?>
				<tr> 
					<td><a href="?p=single&amp;id=<?= $comment->getPostId(); ?>"><?= $comment->getPostId(); ?></a></td>
					<td><em><?= $comment->getComment(); ?></em></td>
					<td><strong><?= $comment->getAuthor(); ?></strong></td>
					<td><a href="?p=admin&amp;menu=comments&amp;action=deleteComment&amp;commentId=<?= $comment->getId(); ?>"><i class="material-icons">delete</i></a></td>
				</tr>
				<?php
		}
		?>
		</tbody>
	</table>
	<div class="col-xs-12 signaled-comments">
		<h4>Commentaire(s) signalé(s)</h4>
		<?php 
	if (empty($this->signaledComments)) {
		echo 'Aucun commentaire n\'a été signalé pour le moment.';
	} else {
		?>
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead>
				<th>Auteur</th>
				<th>Contenu</th>
				<th>Ecrit le</th>
				<th>Action</th>
			</thead>
												
			<tbody>
				<?php
			foreach ($this->signaledComments as $signaledComment) {
				?>
					<tr>
						<td><strong><?= $signaledComment->getAuthor(); ?></strong></td>
						<td><em><?= $signaledComment->getComment(); ?></em></td>
						<td><?= $signaledComment->getCommentDate()->format('d/m/y'); ?></td>
						<td>
							<a title="Valider le commentaire" href="?p=admin&amp;menu=comments&amp;action=validateComment&amp;commentId=<?= $signaledComment->getId(); ?>"><i class="material-icons">done</i></a>
							<a title="Supprimer le commentaire" href="?p=admin&amp;menu=comments&amp;action=deleteComment&amp;commentId=<?= $signaledComment->getId(); ?>"><i class="material-icons">delete</i></a>
						</td>
					</tr>
				<?php
		}
		?>
			</tbody>
		</table>
		<?php
}
?>
	</div>
	<?php
}
?>
<script type="text/javascript" src="public/js/script.js"></script>