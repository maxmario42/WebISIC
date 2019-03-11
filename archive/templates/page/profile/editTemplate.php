<main class="container" style="flex-grow:1;">
    <div class="row justify-content-center">
		<div class="col-lg-6">
		
			<div class="text-center">
				<h2>Editer mon profil</h2>
			</div>
			<form action="<?php echo $this->path('user_edit');?>" method="post">
				<div class="form-group row">
					<label for="nom" class="col-sm-2 col-form-label">Nom</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nom" value="<?php echo $this->safe($this->getUser()->getNom()); ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="prenom" class="col-sm-2 col-form-label">Prenom</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="prenom" value="<?php echo $this->safe($this->getUser()->getPrenom()); ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="pseudo" class="col-sm-2 col-form-label">Pseudo</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pseudo" value="<?php echo $this->safe($this->getUser()->getPseudo()); ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" name="email" value="<?php echo $this->safe($this->getUser()->getEmail()); ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="telephone" class="col-sm-2 col-form-label">Telephone</label>
					<div class="col-sm-10">
						<input type="tel" class="form-control" name="telephone" value="<?php echo $this->safe($this->getUser()->getTelephone()); ?>">
					</div>
				</div>
				<div class="text-center mb-2">
					<a href="<?php echo $this->path('profile'); ?>">
						<button class="btn btn-lg btn-secondary" type="button">
							<span class="fa fa-arrow-circle-left"></span> Retour
						</button>
					</a>
					<button class="btn btn-lg btn-primary" type="submit">
						<span class="fa fa-save"></span> Sauvegarder
					</button>
				</div>
			</form>
			
		</div>
	</div>
 </main>
