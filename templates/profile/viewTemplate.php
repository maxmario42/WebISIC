<h1>Bienvenue <?php echo $user->LOGIN ?></h1>
<main class="container" style="flex-grow:1;">

	<div class="row justify-content-center">
		<div class="col-lg-6 jumbotron py-3">

			<div class="text-center">
				<h2><span class="fa fa-user-circle"></span> Profil</h2>
			</div>
			<table class="table">
				<tr>
					<th scope="row">Nom</th>
					<td><?php echo $user->NOM; ?></td>
				</tr>
				<tr>
					<th scope="row">Prénom</th>
					<td><?php echo $user->PRENOM; ?></td>
				</tr>
				<tr>
					<th scope="row">Mail</th>
					<td><?php echo $user->MAIL_ENSEIGNANT;
							echo $user->MAIL_ETUDIANT; ?></td>
				</tr>
				<?php require_once("viewType/view" . $user->TYPE_UTILISATEUR . "Template.php"); ?>
			</table>
			<button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('User', 'edit'); ?>';">
				<span class="fa fa-pencil-square-o"></span> Edition
			</button>
		</div>
	</div>
</main>