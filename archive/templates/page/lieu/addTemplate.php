<main class="container" style="flex-grow:1;">
	<div class="row justify-content-center">
		<div class="row col-lg-6 justify-content-center jumbotron py-3">

			<div class="text-center"><h2>Ajouter un lieu</h2></div>	
			
			<form action="<?php echo $this->path('add_lieu');?>" method="post" class="col-sm-8">
				<div class="form-group">
					<label for="nom" class="font-weight-bold">Nom :</label>
					<input class="form-control" type="text" name="nom">
					<label for="addr" class="font-weight-bold">Addresse :</label>
					<input class="form-control" type="text" name="addr">
					<label for="addr" class="font-weight-bold">Latitude :</label>
					<input class="form-control" type="number" min="-90" max="90" step="0.000001" name="lat">
					<label for="lon" class="font-weight-bold">Longitude :</label>
					<input class="form-control" type="number" min="-180" max="180" step="0.000001" name="lon">
				</div>
				<div class="text-center">
					<a href="<?php echo $this->path('lieu'); ?>">
						<button class="btn btn-lg btn-secondary mb-2" type="button">
							<span class="fa fa-arrow-left"></span> Retour
						</button>
					</a>
					<button class="btn btn-lg btn-primary mb-2" type="submit">
						<span class="fa fa-check-square-o"></span> Ajouter le lieu
					</button>
				</div>
			</form>
		</div>
	</div>
 </main>
