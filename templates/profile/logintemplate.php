<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-4 text-center jumbotron py-3">
			<form action="<?php echo $this->path('login');?>" method="post">
				<div class="form-group">
					<h2>Connexion</h2>
					<label for="email" class="sr-only">Adresse Email</label>
					<input type="email" name="email" class="form-control" placeholder="Adresse Email" required autofocus>
					<label for="password" class="sr-only">Mot de passe</label>
					<input type="password" name="password" class="form-control" placeholder="Mot de passe" required autofocus>
					<br />
					<button class="btn btn-lg btn-primary btn-block" type="submit">
						<span class="fa fa-sign-in"></span> Se connecter
					</button>
				</div>
			</form>
		<div>
	<div>
<div>
