<?php

class ViewLogin {

	// affiche le contenu de la vue
	public function display() {
		?>
		<br />
		<div class="container">
			<div class="row">
				<div class="class col l4 m6 s12 offset-l4 offset-m3">
					<div class="card-panel">
						<div class="row">
							<div class="col s6 offset-s3">
								<img src="public/img/admin.png" alt="Administrateur" width="100%">
							</div>
						</div>
					</div>

					<h4 class="center-align">Espace d'administration</h4>

					<form method="post">
						<div class="row">
							<div class="input-field col s12">
								<label for="username">Nom d'utilisateur</label>
								<input class="form-control" type="text" name="username" required />
							</div>

							<div class="input-field col s12">
								<label for="password">Mot de passe</label>
								<input class="form-control" type="password" name="password" required />
							</div>
						</div>

						<div class="center">
							<button type="submit" name="submit" class="waves-effect waves-light btn light-blue"><i class="material-icons left">person</i>Se connecter</button>
						</div>
					</form>
				</div>
			</div>
		<?php
	}
}