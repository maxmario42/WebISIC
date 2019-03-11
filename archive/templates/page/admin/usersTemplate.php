 <main class="container mb-5" style="flex-grow:1;">
    <div class="row justify-content-center">
		
		<div class="text-center">
			<h1>Liste des utilisateurs</h1>
		</div>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th scope="col"></th>
						<th scope="col">Id</th>
						<th scope="col">Nom</th>
						<th scope="col">Prénom</th>
						<th scope="col">Email</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->getArg('users') as $user): ?>
						<tr>
							<th scope="row">
								<a href="<?php echo $this->path('profile', array('id' => $user->getId())); ?>">
									<button class="btn btn-info">
										<span class="fa fa-info-circle"></span> Détail
									</button>
								</a>
							</th>
							<th scope="row"><?php echo $user->getId(); ?></th>
							<td><?php echo $user->getNom(); ?></td>
							<td><?php echo $user->getPrenom(); ?></td>
							<td><?php echo $user->getEmail(); ?></td>
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
