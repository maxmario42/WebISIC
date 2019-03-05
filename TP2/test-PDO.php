<style>
	table, th, td {
  border: 1px solid black;
}
</style>


<?php

	error_reporting(E_ALL);
	$verbose = true;

	$mysql_dbname = "maxence_godefert";
	$mysql_user = "maxence.godefert";
	$mysql_password = "?";
	
	$dsn = "mysql:host=localhost;dbname=$mysql_dbname";
	$user = $mysql_user;
	$password = $mysql_password;

	try {
		$pdo = new PDO($dsn,$user,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $erreur) {
		if ($verbose)
			echo 'Erreur : '.$erreur->getMessage();
		else
			echo 'Désolé cher utilisateur...';
	}

	$request = $pdo->prepare("select * from TPWeb");
	if (!$request) {
		var_dump(debug_backtrace());
		die('Error while doing request ' . $sqlRequest);
	}
	$request->execute();
	
	$user = $request->fetch(PDO::FETCH_OBJ);
	
	echo '<h1>Users</h1>
	
	<table>
		<tr>
			<td>Id</td>
			<td>Login</td>
			<td>Password</td>
			<td>Pseudo</td>
		</tr>'; 
	while(!empty($user)) {
		echo '<tr><td>'.$user->id.'</td><td>'.$user->login.'</td><td>'.$user->password.'</td><td>'.$user->pseudo.'</td></tr>';
		$user = $request->fetch(PDO::FETCH_OBJ); 
	}
	echo "</table>";
	
    /*** close the database connection ***/
    $pdo = null;
?>