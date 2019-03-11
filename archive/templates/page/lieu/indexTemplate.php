 <main class="container mb-5" style="flex-grow:1;">
	<h1 class="text-center">Lieux desservis</h1>
	<?php if ($this->getArg('places')): ?>
    	<div class="row justify-content-center">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Nom</th>
							<th scope="col">Adresse</th>
							<th scope="col">Latitude</th>
							<th scope="col">Latitude</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($this->getArg('places') as $place): ?>
							<tr>
								<th scope="col"><?php echo $this->safe($place->getNomLieu()); ?></th>
								<td><?php echo $this->safe($place->getAdresse()); ?></td>
								<td><?php echo $this->safe($place->getLat()); ?></td>
								<td><?php echo $this->safe($place->getLon()); ?></td>
								<th scope="col">
									<a href="<?php echo $this->path('delete_lieu', array('id' => $place->getId())); ?>">
										<button class="btn btn-danger">
											<span class="fa fa-remove"></span> Supprimer
										</button>
									</a>
								</th>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	<?php else: ?>
		<div class="text-center mb-5">
			<h1>Aucun lieu</h1>
			<p>Aucun lieu n'a été répertorié pour le moment. Vous pouvez en ajouter dès maintenant.</p>
		</div>
	<?php endif ?>
	<?php if ($this->getUser()): ?>
		<div class="text-center">
			<a href="<?php echo $this->path('add_lieu'); ?>">
				<button class="btn btn-lg btn-primary my-2">
					<span class="fa fa-plus-circle"></span> Ajouter un lieu
				</button>
			</a>
		</div>
	<?php endif ?>
</main>
