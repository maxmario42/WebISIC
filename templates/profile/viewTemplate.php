

<h1>Bienvenue <?php echo $user->LOGIN?></h1>
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
			</table>
            </div>
		</div>
	</div>
 </main>
