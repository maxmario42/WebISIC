 <main class="container mb-5" style="flex-grow:1;">
    <div class="row justify-content-center">
		<div class="col-lg-6">
			<div class="text-center">
				<h2>Statistiques</h2>
			</div>
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th scope="row">Nombre d'utilisateurs</th>
						<td><?php echo User::countAll(); ?></td>
						<td>
							<a href="<?php echo $this->path('admin_users'); ?>">
								<button class="btn btn-info">
									<span class="fa fa-info-circle"></span> Liste des utilisateurs
								</button>
							</a
						></td>
					</tr>
					<tr>
						<th scope="row">Nombre de trajets</th>
						<td><?php echo Trajet::countAll(); ?></td>
						<td>
							<a href="<?php echo $this->path('admin_trips'); ?>">
								<button class="btn btn-info">
									<span class="fa fa-info-circle"></span> Liste des trajets
								</button>
							</a>
						</td>
					</tr>
					<tr>
						<th scope="row">Nombre de lieu</th>
						<td><?php echo Lieu::countAll(); ?></td>
						<td>
							<a href="<?php echo $this->path('lieu'); ?>">
								<button class="btn btn-info">
									<span class="fa fa-info-circle"></span> Liste des lieux
								</button>
							</a>
						</td>
					</tr>
					<tr>
						<th scope="row">Nombre de véhicule</th>
						<td><?php echo Vehicule::countAll(); ?></td>
						<td>
							<a href="<?php echo $this->path('admin_vehicles'); ?>">
								<button class="btn btn-info">
									<span class="fa fa-info-circle"></span> Liste des véhicules
								</button>
							</a>
						</td>
					</tr>
					<tr>
						<th scope="row">Nombre d'IPs'</th>
						<td><?php echo Ip::countAll(); ?></td>
						<td>
							<a href="<?php echo $this->path('admin_ip'); ?>">
								<button class="btn btn-info">
									<span class="fa fa-info-circle"></span> Liste des IPs
								</button>
							</a>
						</td>
					</tr>
					<tr>
						<th scope="row">Nombre d'étapes</th>
						<td><?php echo Etape::countAll(); ?></td>
						<td></td>
					</tr>
				</table>
			</div>
			<h2 class="text-center">Statistiques jounalisées</h2>

			<div class="card mt-4">
				<div class="card-header text-white bg-secondary">
					<span class="fa fa-bar-chart"></span> Nombre de trajets ces 7 derniers jours
				</div>
				<ul class="list-group list-group-flush">
					<?php foreach ($this->getArg('nbTrajets')['jour'] as $entry): ?>
						<li class="list-group-item">
							<?php echo (new DateTime($entry['DAY']))->format("m/d/Y"); ?> : <?php echo $entry['COUNT']; ?>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
			
			<div class="card mt-4">
				<div class="card-header text-white bg-secondary">
					<span class="fa fa-bar-chart"></span> Nombre de trajtes ces 3 derniers mois
				</div>
				<ul class="list-group list-group-flush">
					<?php foreach ($this->getArg('nbTrajets')['mois'] as $entry): ?>
						<li class="list-group-item">
							<?php echo (new DateTime($entry['MONTH']))->format("m/d/Y"); ?> : <?php echo $entry['COUNT']; ?>
						</li>
					<?php endforeach ?>
				</ul>
			</div>

			<div class="card mt-4">
				<div class="card-header text-white bg-secondary">
					<span class="fa fa-bar-chart"></span> Nombre de trajtes ces 3 dernières années
				</div>
				<ul class="list-group list-group-flush">
					<?php foreach ($this->getArg('nbTrajets')['annee'] as $entry): ?>
						<li class="list-group-item">
							<?php echo (new DateTime($entry['YEAR']))->format("m/d/Y"); ?> : <?php echo $entry['COUNT']; ?>
						</li>
					<?php endforeach ?>
				</ul>
			</div>

			<h2 class="text-center mt-4">Classements</h2>
			
			<div class="card mt-4">
				<div class="card-header text-white bg-secondary">
					<span class="fa fa-bar-chart"></span> Lieux les plus visités
				</div>
				<ul class="list-group list-group-flush">
					<?php foreach ($this->getArg('topSites') as $key=>$entry): ?>
						<li class="list-group-item">
							<?php echo($key+1).'. '.$entry['lieu']; ?> : <?php echo $entry['COUNT']; ?>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
			
			<div class="card mt-4">
				<div class="card-header text-white bg-secondary">
					<span class="fa fa-bar-chart"></span> Utilisateurs ayant créés le plus de trajets
				</div>
				<ul class="list-group list-group-flush">
					<?php foreach ($this->getArg('topCreators') as $key=>$entry): ?>
						<li class="list-group-item">
							<?php echo($key+1).'. '.$entry['user']->getEmail(); ?> : <?php echo $entry['COUNT']; ?>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
 </main>
