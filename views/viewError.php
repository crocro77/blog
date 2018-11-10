<?php

class ViewError {
	
	// affiche le contenu de la vue.
	public function display() {
		?>

		<div class="error-container">
			<div class="container">
				<div class="page-header">
					<h4>Cette page est introuvable.</h4>
				</div>
			</div>
		</div>
		
		<?php
	}
}