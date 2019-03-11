 <main>
    <?php if ($this->getArg('form')): ?>
		<div class="jumbotron jumbotron-fluid py-3">
			<h1 class="text-center">Trouver un trajet</h1>
			<div class="mb-5">
				<form method="get" class="col-12 container-fluid">
					<div class="row container-fluid mb-2">
						<input type="hidden" name="controller" value="<?php echo Request::getCurrentRequest()->getController(); ?>">
						<input type="hidden" name="action" value="<?php echo Request::getCurrentRequest()->getAction(); ?>">
						
						<div class="row container col-12 col-lg-6 m-0 p-0">
							<div class="col-12 col-lg-6">
								<label for="start">Départ</label>
								<select name="start" class="form-control" required>
									<?php foreach ($this->getArg('places') as $place): ?>
										<option value="<?php echo $place->getId(); ?>" <?php echo $place->getId() == $this->getRequest()->GET('start') ? 'selected' : ''; ?>>
											<?php echo $this->safe($place->getNomLieu()); ?>
										</option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-12 col-lg-6">
								<label for="end">Arrivée</label>
								<select name="end" class="form-control" required>
									<?php foreach ($this->getArg('places') as $place): ?>
										<option value="<?php echo $place->getId(); ?>" <?php echo $place->getId() == $this->getRequest()->GET('end') ? 'selected' : ''; ?>>
											<?php echo $this->safe($place->getNomLieu()); ?>
										</option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="row container col-12 col-lg-6 m-0 p-0">
							<div class="col-12 col-lg-6">
								<label for="start-date">Départ minimum</label>
								<div class="form-row">
									<input type="date" name="start-date" class="form-control col-8" required value="<?php echo $this->getRequest()->GET('start-date', (new DateTime())->format('Y-m-d')); ?>">
									<input type="time" name="start-time" class="form-control col-4" required value="<?php echo $this->getRequest()->GET('start-time', (new DateTime())->format('H:i')); ?>">
								</div>
							</div>
							<div class="col-12 col-lg-6">
								<label for="end-date">Départ maximum</label>
								<div class="form-row">
									<input type="date" name="end-date" class="form-control col-8" required value="<?php echo $this->getRequest()->GET('end-date', (new DateTime('+1day'))->format('Y-m-d')); ?>">
									<input type="time" name="end-time" class="form-control col-4" required value="<?php echo $this->getRequest()->GET('end-time', (new DateTime('+1day'))->format('H:i')); ?>">
								</div>
							</div>
						</div>
					</div>
					
					<div class="text-center">
						<button class="btn btn-primary btn-lg" name="submit" type="submit">
							<span class="fa fa-search"></span> Trouver
						</button>
					</div>
				</form>
			</div>
		</div>
	<?php else: ?>
		<div class="text-center mt-3">
			<?php if ($this->getRequest()->getAction()=='myTrips'): ?>
				<h1>Mes trajets</h1>
			<?php elseif ($this->getRequest()->getAction()=='myBookings'): ?>
				<h1>Mes réservations</h1>
				<?php if (!$this->getArg('trajets')): ?>
					<p>Aucune réservation n'a été trouvée</p>
				<?php endif ?>
			<?php else: ?>
				<h1>Liste des trajets</h1>
			<?php endif ?>
		</div>
	<?php endif ?>
	<div class="text-center">
		<?php
            if (isset($_GET['submit']) && $this->getArg('trajets') === array()) {
                echo "<h1>Aucun résultat</h1>";
                echo "Aucun trajet ne correspond à votre recherche";
            }
        ?>
		<?php if ($this->getArg('trajets')): ?>
			<?php include_once(__ROOT_DIR.'/templates/page/trip/listTemplate.php'); ?>
		<?php endif ?>
	</div>
</main>
