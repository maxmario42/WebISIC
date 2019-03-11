 <main class="container mb-5" style="flex-grow:1;">
    <div class="row justify-content-center">
		
		<div class="text-center">
			<h1>Liste des IPs</h1>
		</div>
		<div class="table-responsive text-center">
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th scope="col">IP</th>
						<th scope="col">Banni</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->getArg('ips') as $ip): ?>
						<tr>
							<td>
								<?php echo $ip; ?>
							</td>
							<td>
								<?php if ($ip->getIpBanni()): ?>
									<a href='<?php echo $this->path('admin_ip_unban', array('id' => $ip->getId())); ?>'class='btn btn-danger'>
										<span class="fa fa-unlock"></span> Débannir
									</a>
								<?php else: ?>
									<a href='<?php echo $this->path('admin_ip_ban', array('id' => $ip->getId())); ?>'class='btn btn-danger'>
										<span class="fa fa-lock"></span> Bannir
									</a>
								<?php endif ?>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="text-center">
			<a href="<?php echo $this->path('admin'); ?>"
				<button class="btn btn-lg btn-secondary mb-2">Retour</button>
			</a>
		</div>
	
	</div>
</main>
