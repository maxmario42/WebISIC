 <main class="container" style="flex-grow:1;">
    <div class="row justify-content-center">
		<div class="row col-lg-6 justify-content-center">
			<h2 class="text-center">Ajouter un véhicule</h2>
			<form action="<?php echo $this->path('add_vehicle'); ?>" method="post" class="col-sm-8 jumbotron py-3">
				<?php if (!$this->getArg('marque')): // MARQUE ?>
					<div class="form-group">
						<label for="marque">Marque :</label>
						<select onchange="Hide(this.value, 'autreMarque');" class="form-control" name="marque">
							<option value="">Autre :</option>
							<?php foreach ($this->getArg('marques') as $marque): ?>
								<option value="<?php echo $marque->getId(); ?>">
									<?php echo $this->safe($marque); ?>
								</option>
							<?php endforeach ?>
						</select>
						<input class="form-control" type="text" name="marque-input" id="autreMarque">
					</div>
				<?php else: // MARQUE + MODELE ?>
					<input type="hidden" name="marque" value="<?php echo $this->getArg('marque')->getId(); ?>">
					<div class="label">Marque :</div><?php echo $this->safe($this->getArg('marque')); ?>
					
					<?php if (!$this->getArg('modele')): ?>
					<div class="form-group mt-2">
						<label for="modele">Modèle :</label>
						<select onchange="Hide(this.value, 'autreModele');" class="form-control" name="modele">
							<option value="">Autre :</option>
							<?php foreach ($this->getArg('modeles') as $modele): ?>
								<option value="<?php echo $modele->getId(); ?>">
									<?php echo $this->safe($modele->modeleString()); ?>
								</option>
							<?php endforeach ?>
						</select>
						<div id="autreModele">
							<label for="modele-name" class="font-weight-normal">Nom modèle:</label>
							<input class="form-control" type="text" name="modele-name">
							<label for="modele-year" class="font-weight-normal">Année:</label>
							<input class="form-control" type="number" step="1" name="modele-year">
						</div>
					</div>
					<?php else: // MARQUE + MODELE + COULEUR ?>
						<input type="hidden" name="modele" value="<?php echo $this->getArg('modele')->getId(); ?>">
						<div class="font-weight-bold mt-2">Modèle :</div><?php echo $this->safe($this->getArg('modele')); ?>

						<div class="form-group mt-2">
							<label for="couleur">Couleur :</label>
							<select onchange="Hide(this.value, 'autreCouleur');" class="form-control" name="couleur">
								<option value="">Autre :</option>
								<?php foreach ($this->getArg('couleurs') as $couleur): ?>
									<option value="<?php echo $couleur->getId(); ?>">
										<?php echo $this->safe($couleur); ?>
									</option>
								<?php endforeach ?>
							</select>
							<div id="autreCouleur">
								<input class="form-control" type="text" name="couleur-input">
							</div>
						</div>
					<?php endif ?>
				<?php endif ?>

				<div class="text-center">
					<a href="<?php echo $this->path('my_vehicles'); ?>">
						<button class="btn btn-lg btn-secondary mb-2">
							<span class="fa fa-arrow-left"></span> Retour
						</button>
					</a>
					<button class="btn btn-lg btn-primary mb-2" type="submit">
						Suivant <span class="fa fa-arrow-right"></span>
					</button>
				</div>
			</form>

			<script>
			function Hide(value, id)
			{
			if(value=='')
			{
				document.getElementById(id).style.display='';
			}
			else
			{ 
			    document.getElementById(id).style.display='none';
				}
			} 
		   </script>
		</div>
	</div>
 </main>
