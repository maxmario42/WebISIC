	</div>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery-3.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<!-- <script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery-slim.min.js"><\/script>')</script> -->
	<script src="assets/js/popper.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<?php if (count($this->getNotifications()) > 0): ?>
		<script src="assets/js/bootstrap-notify.min.js"></script>
		<script>
			<?php foreach ($this->getNotifications() as $notification): ?>
			$.notify({icon:'assets/img/<?php echo $notification['type']; ?>.svg',message:'<?php echo $notification['message']; ?>'},{type:'<?php echo $notification['type']; ?>', icon_type: 'img'});
			<?php endforeach ?>
		</script>
		<?php $this->resetNotifications(); ?>
	<?php endif ?>
</body>
</html>
