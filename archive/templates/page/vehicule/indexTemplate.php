 <main class="container" style="flex-grow:1;">
    <div class="row justify-content-center">
		<div class="col-lg-6">
			<?php if ($this->getArg('vehicules')): ?>
				<?php foreach ($this->getArg('vehicules') as $vehicule): ?>
				<div class="card bg-light my-3">
					<div class="card-header bg-dark text-white">
						<?php echo $this->safe($vehicule->getModele()->getMarque()); ?>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item bg-light">Modèle : <?php echo $this->safe($vehicule->getModele()->modeleString()); ?></li>
						<li class="list-group-item bg-light">Couleur : <?php echo $this->safe($vehicule->getCouleur()); ?></li>
					</ul>
					<div class="card-body text-center">
						<a href="<?php echo $this->path('delete_vehicle', array('id' => $vehicule->getId())); ?>">
							<button class="btn btn-danger">
								<span class="fa fa-remove"></span> Supprimer
							</button>
						</a>
					</div>
				</div>
			<?php endforeach ?>
			<?php else: ?>
				<div class="text-center mb-5">
					<h1>Aucun véhicule</h1>
					<p>Vous n'avez pas encore ajouté de véhicule à votre profil.</p>
				</div>
			<?php endif ?>
			
			<div class="text-center">
				<a href="<?php echo $this->path('add_vehicle'); ?>">
					<button class="btn btn-lg btn-primary mb-2">
						<span class="fa fa-plus-circle"></span> Ajouter un véhicule
					</button>
				</a>
			</div>
 		</div>
	</div>
 </main>
