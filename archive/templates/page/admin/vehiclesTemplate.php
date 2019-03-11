 <main class="container mb-5" style="flex-grow:1;">
    <div class="row justify-content-center">
		
		<div class="text-center">
			<h1>Liste des véhicules</h1>
		</div>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Modèle</th>
						<th scope="col">Couleur</th>
						<th scope="col">Utilisateur</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->getArg('vehicles') as $vehicle): ?>
						<tr>
							<th scope="col"><?php echo $vehicle->getId(); ?></th>
							<td><?php echo $vehicle->getModele(); ?></td>
							<td><?php echo $vehicle->getCouleur(); ?></td>
							<td><?php echo $vehicle->getUser()->getEmail(); ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="text-center">
			<a href="<?php echo $this->path('admin'); ?>"
				<button class="btn btn-lg btn-secondary mb-2">Retour</button>
			</a>
		</div>
	
	</div>
</main>
