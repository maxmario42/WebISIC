	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand" href="<?php echo $this->path('home'); ?>" class="btn btn-secondary my-2 my-sm-0">
			<img src="assets/img/logo.png" alt="" width="30" height="30">
			Dracar
		</a>
		<button class="navbar-toggler" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse justify-content-end" id="nav-content">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link text-center" href="<?php echo $this->path('search_trip'); ?>">
						<span class="fa fa-search"></span> Trouver un trajet
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-center" href="<?php echo $this->path('lieu'); ?>">
						<span class="fa fa-location-arrow"></span> Lieux desservis
					</a>
				</li>
				<?php if ($this->getUser() != null): ?>
					<li class="nav-item text-center">
						<a class="nav-link" href="<?php echo $this->path('add_trip'); ?>">
							<span class="fa fa-plus-circle"></span> Proposer un trajet
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-center" href="<?php echo $this->path('groups'); ?>">
							<span class="fa fa-users"></span> Groupes
						</a>
					</li>
					<?php if ($this->getUser()->getAdmin()): ?>
					    <li class="nav-item text-center">
							<a class="nav-link" href="<?php echo $this->path('admin'); ?>">
								<span class="fa fa-bar-chart"></span> Administration
							</a>
						</li>
					<?php endif ?>
					<li class="nav-item dropdown text-center">
						<a class="dropdown-toggle btn btn-primary" href="#" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="fa fa fa-user-circle-o"></span> Mon compte
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdown04">
							<a class="dropdown-item text-center" href="<?php echo $this->path('profile'); ?>">Mon profil</a>
							<a class="dropdown-item text-center" href="<?php echo $this->path('my_trips'); ?>">Mes trajets</a>
							<a class="dropdown-item text-center" href="<?php echo $this->path('trip_my_bookings'); ?>">Mes réservations</a>
							<a class="dropdown-item text-center" href="<?php echo $this->path('my_vehicles'); ?>">Mes véhicules</a>
							<a class="dropdown-item text-center text-primary" href="<?php echo $this->path('logout'); ?>">Déconnexion</a>
						</div>
					</li>
                <?php else: ?>
					<li class="nav-item">
						<a class="btn btn-secondary my-1 my-md-0 w-100" href="<?php echo $this->path('login'); ?>">
							<span class="fa fa-sign-in"></span> Se connecter
						</a>
					</li>
					<li class="nav-item mx-md-2">
						<a href="<?php echo $this->path('inscription'); ?>" class="btn btn-primary my-1 my-md-0 w-100" role="button">
							<span class="fa fa-pencil-square-o"></span> S'inscrire
						</a>
					</li>
				<?php endif ?>
			</ul>
		</div>
    </nav>
