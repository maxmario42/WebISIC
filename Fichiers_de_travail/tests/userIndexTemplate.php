<div id="content">

<h2>Etat des lecteurs par Sites</h2>

<table>
	<tr>
		<th>Sites : </th>
		<td><select id="sitesSelect">
		<?php
			echo "<option value='none'>None</option>";
			foreach($sites as $site) {
				echo "<option value='". $site->id()."'>" . $site->label() . "</option>";
			}
		?>
		</select></td>
	</tr>
	
	<tr id="batimentsTr">
		<th>Batiments : </th>
		<td><select id="batimentsSelect">
			<option value='none'>None</option>
		</select></td>
	</tr>

</table> 


<script>

$(document).ready(function(){
	$("#batimentsTr").hide();
	
	$("#sitesSelect").on("change", function() {
		// var selectedSite = $('#batimentSelect').find(":selected").text();
		var selectedSiteId = this.value;
	
		console.log(selectedSiteId);
		
		var loadBatimentsOfSiteURL = "<?php
			echo $controller->linkTo('loadBatimentsOfSiteJSON','user'); ?>";
		// loadBatimentsOfSiteURL += '&siteName=' + selectedSite;
		
		console.log("AJAX to loadBatimentsOfSite " + selectedSiteId);

		var url = loadBatimentsOfSiteURL + "&siteId=" + selectedSiteId;
		console.log(url);
		
		var jqxhr = $.getJSON( url, // L'url vers laquelle la requete sera envoyee
		  function(data, textStatus, jqXHR) {
		    // La reponse du serveur est contenu dans data
		    // On peut faire ce qu'on veut avec ici
		    var batimentsList = data;
			var batimentsSelect = $("#batimentsSelect");
			batimentsSelect.empty();
			$.each(batimentsList, function(k,bat) {
				batimentsSelect.append("<option value='" + bat.id + "'>" + bat.name + "</option>");
			});
			$("#batimentsTr").show();
		}).fail(function(e) {
		    console.log( "AJAX error : " );
		    console.log( e );
		});
		
	});
});
	
</script>

