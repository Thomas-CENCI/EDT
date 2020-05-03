<head>
	<meta name=description content="Demande d'un évennement - ENSEIGNANT">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php

$hostname ="sql7.freemysqlhosting.net:3306";
$username="sql7336475";
$password="ItBWtR3xM5";
$db="sql7336475";
$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

$SQL_nom = "SELECT identifiant FROM cours";
$requete_nom = mysqli_query($conn, $SQL_nom);

$SQL_module = "SELECT identifiant FROM modules";
$requete_module = mysqli_query($conn, $SQL_module);

// $duree = 

$SQL_enseignant = "SELECT identifiant FROM user WHERE type LIKE 'type de l'enseignant";
$requete_enseignant = mysqli_query($conn, $SQL_enseignant);

$SQL_salle = "SELECT identifiant FROM salles";
$requete_salle = mysqli_query($conn, $SQL_salle);

// $date = 

$SQL_groupe = "SELECT identifiant FROM groupe";
$requete_groupe = mysqli_query($conn, $SQL_groupe);

?>

<!DOCTYPE html>
<html>
	<head>
		<h1 style="text-align: center;">Demande de création d'un évennement - ENSEIGNANT</h1>
		<meta charset = 'utf-8'>
		<link rel='stylesheet' href='page3.css'>
	</head>
	<div>
		<form id='data' action='page1.php' method='GET'>
			<div class="dropdown">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Nom de l'évennement
			  	</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

					<?php
					while($data_nom = mysqli_fetch_array($requete_nom)){
						$nom = $data_nom['nom'];
						echo("<button class = 'dropdownitem' type = 'submit'> ".$nom." </button>");
					}
			    	?>

			  	</div>

				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Nom du module
			  	</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

					<?php
			    	while($data_module = mysqli_fetch_array($requete_module)){
						$module = $data_module['nom'];
						echo("<button class = 'dropdownitem' type = 'submit'> ".$module." </button>");
					}
			    	?>

			  	</div>

				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Durée de l'évennement
			  	</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

					<?php
					echo("<button class = 'dropdownitem' type = 'submit'> ".$duree." </button>");
			    	?>

			  	</div>

				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Nom de l'enseignant
			  	</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

					<?php
			    	while($data_enseignant = mysqli_fetch_array($requete_enseignant)){
						$enseignant = $data_enseignant['nom'];
						echo("<button class = 'dropdownitem' type = 'submit'> ".$enseignant." </button>");
					}
			    	?>

			  	</div>

				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Nom de la salle
			  	</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

					<?php
			    	while($data_sale = mysqli_fetch_array($requete_salle)){
						$salle = $data_salle['nom'];
						echo("<button class = 'dropdownitem' type = 'submit'> ".$salle." </button>");
					}
			    	?>

			  	</div>

				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Date de l'évennement
			  	</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

					<?php
					echo("<button class = 'dropdownitem' type = 'submit'> ".$date." </button>");
			    	?>

			  	</div>

				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Groupe(s) concerné(s)
			  	</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

					<?php
			    	while($data_groupe = mysqli_fetch_array($requete_groupe)){
						$groupe = $data_groupe['nom'];
						echo("<button class = 'dropdownitem' type = 'submit'> ".$salle." </button>");
					}
			    	?>

			  	</div>
			</div>
			<p><input type="submit" value="Valider" style="float: right; width: 25%;"></p>
		</form>
	</div>
</html>