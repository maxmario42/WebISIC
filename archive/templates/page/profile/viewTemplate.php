<main class="container" style="flex-grow:1;">
    <div class="row justify-content-center">
		<div class="col-lg-6 jumbotron py-3">
		
			<div class="text-center">
				<h2><span class="fa fa-user-circle"></span> Profil</h2>
			</div>	
			<table class="table">
				<tr>
					<th scope="row">Nom</th>
					<td><?php echo $this->safe($this->getArg('user')->getNom()); ?></td>
				</tr>
				<tr>
					<th scope="row">Prénom</th>
					<td><?php echo $this->safe($this->getArg('user')->getPrenom()); ?></td>
				</tr>
				<tr>
					<th scope="row">Pseudo</th>
					<td><?php echo $this->safe($this->getArg('user')->getPseudo()); ?></td>
				</tr>
				<tr>
					<th scope="row">Email</th>
					<td><?php echo $this->safe($this->getArg('user')->getEmail()); ?></td>
				</tr>
				<tr>
					<th scope="row">Téléphone</th>
					<td><?php echo $this->getArg('user')->getTelephone(); ?></td>
				</tr>
				<tr>
					<th scope="row">Nombre de trajet créé</th>
					<td><?php echo $this->getArg('nbTrajets'); ?></td>
				</tr>
			</table>
			<div class="text-center">
				<?php if ($this->getUser()): ?>
					<?php if ($this->getUser()->getId() == $this->getArg('user')->getId()): ?>
						<div class="mt-3">
							<a href="<?php echo $this->path('user_edit'); ?>">
								<button class="btn btn-primary btn-lg">
									<span class="fa fa-pencil-square-o"></span> Editer mes informations
								</button>
							</a>
						</div>
					<?php endif ?>
					<?php if (!$this->getArg('user')->getAdmin() && $this->getUser()->getAdmin()): ?>
						<?php if (!$this->getArg('user')->getBanni()): ?>
							<a href="<?php echo $this->path('admin_user_ban', array('id' => $this->getArg('user')->getId())); ?>">
								<button class="btn btn-danger">
									<span class="fa fa-remove"></span> Bannir
								</button>
							</a>
							<a href="<?php echo $this->path('admin_user_promote', array('id' => $this->getArg('user')->getId())); ?>">
								<button class="btn btn-danger">
									<span class="fa fa-black-tie"></span> Promouvoir administrateur
								</button>
							</a>
						<?php else: ?>
							<a href="<?php echo $this->path('admin_user_unban', array('id' => $this->getArg('user')->getId())); ?>"><button class="btn btn-success">Débannir</button></a>
						<?php endif ?>
					<?php endif ?>
				<?php endif ?>
			</div>
		</div>
		<div class="container">
			<h1 class="text-center mt-4">Trajets actuellement proposés</h1>
			<?php if ($this->getArg('trajets') != array()): ?>
				<?php include_once(__ROOT_DIR.'/templates/page/trip/listTemplate.php'); ?>
			<?php else: ?>
				<p class="text-center">Aucun trajet n'a été trouvé.</p>
			<?php endif ?>
		</div>
	</div>
 </main>
