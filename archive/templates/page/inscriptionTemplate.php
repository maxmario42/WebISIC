<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-4 text-center">
			<form action="<?php echo $this->path('validate_inscription');?>" method="post" class="jumbotron py-3">
				<div class="form-group">
					<h2>Inscription</h2>
					<label for="nom" class="sr-only">Nom</label>
					<input type="text" name="nom" class="form-control" placeholder="Nom" value="<?php echo $this->getRequest()->POST('nom'); ?>" required autofocus>
					
					<label for="prenom" class="sr-only">Prénom</label>
					<input type="text" name="prenom" class="form-control" placeholder="Prénom" value="<?php echo $this->getRequest()->POST('prenom'); ?>" required>
					
					<label for="email" class="sr-only">Adresse Email</label>
					<input type="email" name="email" class="form-control" placeholder="Adresse Email" value="<?php echo $this->getRequest()->POST('email'); ?>" required>

					<label for="telephone" class="sr-only">Téléphone</label>
					<input type="tel" name="telephone" class="form-control" placeholder="Téléphone" value="<?php echo $this->getRequest()->POST('telephone'); ?>">
					<br/>
					<label for="pseudo" class="sr-only">Identifiant</label>
					<input type="text" name="pseudo" class="form-control" placeholder="Identifiant" value="<?php echo $this->getRequest()->POST('pseudo'); ?>" required>
					
					<label for="password" class="sr-only">Mot de passe</label>
					<input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
					
					<label for="passwordConfirm" class="sr-only">Confirmez le mot de passe</label>
					<input type="password" name="passwordConfirm" class="form-control" placeholder="Confirmez le mot de passe" required>
					<br/>
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit">
						<span class="fa fa-pencil-square-o"></span> Créer mon compte
					</button>
					<br/>
				</div>
			</form>
			<h2>Ou</h2>
			<?php
				echo '<a class="btn btn-lg btn-secondary btn-block" href="'.$this->path('login').'"><span class="fa fa-sign-in"></span> Se connecter</a>';
			?>
		<div>
	<div>
<div>
