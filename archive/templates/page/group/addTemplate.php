<main class="container" style="flex-grow:1;">
	<div class="row justify-content-center">
		<div class="row col-lg-6 justify-content-center">
			<div class="text-center"><h2>Ajouter un groupe</h2></div>	
			<form action="<?php echo $this->path('group_add');?>" method="post" class="col-sm-8">
				<div class="form-group">
					<label for="nom" class="font-weight-bold">Nom du groupe:</label>
					<input class="form-control" type="text" name="nom">
				</div>
				<div class="text-center">
					<a href="<?php echo $this->path('groups'); ?>"><button class="btn btn-lg btn-secondary mb-2" type="button">
						<span class="fa fa-arrow-left"></span> Retour
					</button></a>
					<button class="btn btn-lg btn-primary mb-2" type="submit">
						<span class="fa fa-check-square"></span> Ajouter le groupe
					</button>
				</div>
			</form>
		</div>
	</div>
 </main>
