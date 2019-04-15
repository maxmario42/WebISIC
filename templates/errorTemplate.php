<div class="container">
	<main>
		<div style="text-align: center">
			<h1><?php echo $this->getArg('error')->getCode(); ?></h1>
			<p><?php echo $this->getArg('error')->getMessage() ?: 'Erreur inconnue'; ?></p>
		</div>
	</main>
</div>
