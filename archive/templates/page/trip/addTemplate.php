<main class="container" style="flex-grow:1;">
    <div class="row justify-content-center">
		<div class="row col-lg-6 justify-content-center jumbotron py-3">
			<div class="text-center"><h2>Proposer un trajet</h2></div>	
			<form action="<?php echo $this->path('add_trip');?>" method="post" class="col-sm-12">
				<div class="form-group">
					<label for="places" class="font-weight-bold">Nombre de places proposés :</label>
					<input class="form-control" type="number" min="1" step="1" name="places" value="<?php echo $this->getRequest()->POST('places', 3); ?>">
				</div>
				<div class="form-group mt-2">
					<label for="type">Type :</label>
					<select onchange="Hide(this.value, 'type-input');" class="form-control" name="type">
						<option value="">Autre :</option>
						<?php foreach ($this->getArg('types') as $type): ?>
							<option value="<?php echo $type->getId(); ?>" <?php echo $this->getRequest()->POST('type') == $type->getId() ? 'selected' : ''; ?>>
								<?php echo $this->safe($type); ?>
							</option>
						<?php endforeach ?>
					</select>
					<input class="form-control" type="text" name="type-input" id="type-input"
						style="<?php echo $this->getRequest()->POST('type') ? 'display:none' : ''; ?>"
						value="<?php echo $this->getRequest()->POST('type-input'); ?>"
					>
				</div>
				<div class="form-group mt-2">
					<label for="vehicules[]">Véhicules :</label>
					<select class="form-control" name="vehicules[]" multiple="true">
						<?php foreach ($this->getArg('vehicules') as $vehicle): ?>
							<option value="<?php echo $vehicle->getId(); ?>" <?php echo in_array($vehicle->getId(), $this->getRequest()->POST('vehicules', array())) ? 'selected' : ''; ?>>
								<?php echo $this->safe($vehicle); ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group mt-2">
					<?php foreach (range(1, $this->getArg('nbEtapes')) as $i): ?>
						<div>
							<p class="label">Etape <?php echo $i; ?> :</p>
							<div class="form-group row">
								<label for="etapes[<?php echo $i; ?>][lieu]" class="col-sm-4 col-form-label font-weight-normal">Lieu</label>
								<div class="col-sm-8">
									<select class="form-control" name="etapes[<?php echo $i; ?>][lieu]">
										<?php foreach ($this->getArg('places') as $lieu): ?>
											<option value="<?php echo $lieu->getId(); ?>"
												<?php echo isset($this->getRequest()->POST('etapes')[$i]['lieu']) && $lieu->getId() == $this->getRequest()->POST('etapes')[$i]['lieu'] ? 'selected' : ''; ?>
											>
												<?php echo $this->safe($lieu); ?>
											</option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="etapes[<?php echo $i; ?>][date]" class="col-sm-4 col-form-label font-weight-normal">Date</label>
								<div class="form-row col-sm-8" style="margin:0">
									<input class="col-8 form-control" type="date" name="etapes[<?php echo $i; ?>][date]" value="<?php echo isset($this->getRequest()->POST('etapes')[$i]['date']) ? $this->getRequest()->POST('etapes')[$i]['date'] : ''?>">
									<input class="col-4 form-control" type="time" name="etapes[<?php echo $i; ?>][time]" value="<?php echo isset($this->getRequest()->POST('etapes')[$i]['date']) ? $this->getRequest()->POST('etapes')[$i]['time'] : ''?>">								</div>
							</div>
						</div>
					<?php endforeach ?>
					<div class="text-center">
						<?php if ($this->getArg('nbEtapes') > 2): ?>
							<button class="btn btn-lg btn-light mb-2" type="submit" value="false"
							formaction="<?php echo $this->path('add_trip', array('nb_etapes' => $this->getArg('nbEtapes') - 1));?>">
								<span class="fa fa-minus-circle"></span> Etape
							</button>
						<?php endif ?>
						<button class="btn btn-lg btn-light mb-2" type="submit" value="false"
						formaction="<?php echo $this->path('add_trip', array('nb_etapes' => $this->getArg('nbEtapes') + 1));?>">
							<span class="fa fa-plus-circle"></span> Etape
						</button>
					</div>
				</div>
				<div class="text-center">
					<button class="btn btn-lg btn-primary mb-2" type="submit" name="submit" value="true">
						<span class="fa fa-check-square-o"></span> Créer le trajet
					</button>
				</div>
			</form>
		
			<script>
			function Hide(value, id)
			{
				if(value=='')
				{
					document.getElementById(id).style.display='';
				}
				else
				{ 
					document.getElementById(id).style.display='none';
				}
			} 
		   </script>
		   
		</div>
	</div>
</main>
