<h2>Inscription</h2>
<?php
if(isset($inscErrorText))
echo '<span class="error">' . $inscErrorText . '</span>';
?>
<form action="index.php" method="post">
<table>
<tr>
<th>mail* :</th>
<td><input type="text" name="mail"/></td>
</tr>
<tr>
<th>Mot de passe* :</th>
<td><input type="password" name="inscPassword"/></td>
</tr>
<tr>
<th>Nom:</th>
<td><input type="text" name="nom"/></td>
</tr>
<tr>
<th>Prenom :</th>
<td><input type="text" name="prenom"/></td>
</tr>
<tr>
<th>Promo :</th>
<td><input type="text" name="promo"/></td>
</tr>
<tr>
<th>Anne de sortie:</th>
<td><input type="text" name="anne-sortie"/></td>
</tr>
<tr>
<th>
<td><input type="submit" value="Creer mon compte..." /></td>
</tr>
</table>
</form>