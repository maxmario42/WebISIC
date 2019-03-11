<main class="container">
	<div class="row justify-content-center">
		<div class="col-lg-6">
			<div class="text-center">
				<h1>Trajet n°<?php echo $this->getArg('trip')->getId(); ?></h1>
			</div>
			<div class="card mt-4">
				<ul class="list-group list-group-flush">
					<li class="list-group-item">Places restantes : <?php echo $this->getArg('trip')->getPlacesRestantes(); ?></li>
					<li class="list-group-item">Type : <?php echo $this->safe($this->getArg('trip')->getTypeTrajet()); ?></li>
					<li class="list-group-item">Créateur : <?php echo $this->safe($this->getArg('trip')->getUser()->getEmail()); ?> 
						<a href="<?php echo $this->path('profile', array('id' => $this->getArg('trip')->getIdUser())); ?>">
							<button class="btn btn-info btn-sm float-right">
								<span class="fa fa-info-circle"></span> Détail
							</button>
						</a>
					</li>
				</ul>
			</div>
			<div class="card mt-4">
				<div class="card-header text-white bg-secondary">
					<span class="fa fa-location-arrow"></span> Etapes
				</div>
				<ul class="list-group list-group-flush">
					<?php foreach ($this->getArg('trip')->getEtapes() as $etape): ?>
						<li class="list-group-item">
							<?php echo (new DateTime($etape->getHeure()))->format("m/d/Y H\hi"); ?> à <?php echo $this->safe($etape->getLieu()); ?>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
			<div class="card mt-4">
				<div class="card-header text-white bg-secondary">
					<span class="fa fa-car"></span> Véhicules
				</div>
				<ul class="list-group list-group-flush">
					<?php foreach ($this->getArg('trip')->getVehicules() as $vehicule): ?>
						<li class="list-group-item">
							<?php echo $this->safe($vehicule->getVehicule()->getModele()); ?> de couleur <?php echo $this->safe($vehicule->getVehicule()->getCouleur()); ?>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
			<div class="card mt-4">
				<div class="card-header text-white bg-secondary">
					<span class="fa fa-users"></span> Participants
				</div>
				<ul class="list-group list-group-flush">
					<?php if (!$this->getArg('trip')->getParticipants()): ?>
						<li class="list-group-item">(Aucun)</li>
					<?php else: ?>
						<?php foreach ($this->getArg('trip')->getParticipants() as $participant): ?>
							<li class="list-group-item">
								<?php echo $this->safe($participant->getUser()->getEmail()); ?>
								<?php if ($this->getArg('isModerator')): ?>
									<a class="btn-sm btn-danger float-right"
										href="<?php echo $this->path('trip_remove_participant', array(
                                            'id' => $this->getArg('trip')->getId(),
                                            'id_user' => $participant->getUser()->getId())
                                        );?>">
										<span class="fa fa-remove"></span> Supprimer
									</a>
								<?php endif ?>
							</li>
						<?php endforeach ?>
					<?php endif ?>
				</ul>
			</div>
			<div class="card mt-4">     
				<div class="card-header text-white bg-secondary">
					<span class="fa fa-user-secret"></span> Modérateurs
				</div>
				<ul class="list-group list-group-flush">
					<?php if (!$this->getArg('trip')->getModerators()): ?>
						<li class="list-group-item">(Aucun)</li>
					<?php else: ?>
						<?php foreach ($this->getArg('trip')->getModerators() as $moderator): ?>
							<li class="list-group-item">
								<?php echo $this->safe($moderator->getUser()->getEmail()); ?>
								<?php if ($this->getArg('isAdmin')): ?>
									<a class="btn-sm btn-danger float-right"
										href="<?php echo $this->path('trip_remove_moderator', array('id' => $this->getArg('trip')->getId(), 'id_user' => $moderator->getUser()->getId()));?>">
										<span class="fa fa-remove"></span> Supprimer
									</a>
								<?php endif ?>
							</li>
						<?php endforeach ?>
					<?php endif ?>
					<?php if ($this->getArg('isAdmin')): ?>
						<li class="list-group-item">
							<form action="<?php echo $this->path('trip', array('id' => $this->getArg('trip')->getId()));?>" method="post">
								<label for="email">Adresse Email</label>
								<input type="email" name="email" class="form-control" placeholder="Adresse Email" required>
								<button class="btn btn-lg btn-primary btn-block" type="submit">
									<span class="fa fa-plus-circle"></span> Ajouter un modérateur
								</button>
							</form>
						</li>
					<?php endif ?>
				</ul>
			</div>
			
			<div class="text-center card-body">
				<?php if ($this->getArg('isCreator')): ?>
					<?php if ($this->getArg('trip')->getBloquer()): ?>
						<a href='<?php echo $this->path('trip_unlock', array('id' => $this->getArg('trip')->getId())); ?>'class='btn btn-danger'>
							<span class="fa fa-unlock"></span> Débloquer
						</a>
					<?php else: ?>
						<a href='<?php echo $this->path('trip_lock', array('id' => $this->getArg('trip')->getId())); ?>'class='btn btn-danger'>
							<span class="fa fa-lock"></span> Bloquer
						</a>
					<?php endif ?>
				<?php endif ?>
				<?php if ($this->getArg('isSignup')): ?>
					<a href='<?php echo $this->path('trip_signout', array('id' => $this->getArg('trip')->getId())); ?>' class='btn btn-primary'>
						<span class="fa fa-sign-out"></span> Se désinscrire
					</a>
				<?php else: ?>
					<a href='<?php echo $this->path('trip_signup', array('id' => $this->getArg('trip')->getId())); ?>'
						class='btn btn-primary <?php echo ($this->getUser() == null || $this->getArg('trip')->isFull()) ? 'disabled' : ''; ?>'>
						<span class="fa fa-sign-in"></span> S'inscrire
					</a>
				<?php endif ?>
			</div>
		</div>
	</div>
</main>
