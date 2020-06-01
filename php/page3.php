<head>
	<meta name=description content="Demande de création d'un évennement">
	<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php

$hostname ="sql7.freemysqlhosting.net:3306";
$username="sql7336475";
$password="ItBWtR3xM5";
$db="sql7336475";
$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

$SQL_salle = "SELECT salles.nom FROM salles";
$requete_salle = mysqli_query($conn, $SQL_salle);

// if isset $_POST("submit"){
	// $nom
	// $date
	// $enseignant
	// $salle
	// $heureFin
	// $heureDebut
	// $groupe
// }

?>

<!DOCTYPE html>
<html>
	<head>
		<h1 style="text-align: center;">Demande de création d'un évennement - ENSEIGNANT</h1>
		<meta charset = 'utf-8'>
		<link rel='stylesheet' href='page3.css'>
	</head>
	<div>
		<form id='data' method='POST'>
			<div>
				<div style="float:left; border-spacing: 10px">

					<?php
						echo("<form method='POST'><p> Nom de l'évennement <input name='nom' id='name'/></p></form>");
						if(isset($_POST["nom"])){
							$nom = $_POST["nom"];
						}
			    	?>

			  	</div>

			  	<div style="float:left; border-spacing: 10px">

					<?php
						echo("<form method='POST'><p> Nom de l'enseignant <input name='enseignant' id='enseignant'/></p></form>");
						if(isset($_POST['enseignant'])){
							$enseignant = $_POST["enseignant"];
						}
			    	?>

			  	</div>

			  	<div style="float:left; border-spacing: 10px">

					<?php
						echo("<form method='POST'><p> Groupe(s) concerné(s) <input name='groupe' id='groupe'/></p></form>");
						if(isset($_POST['groupe'])){
							$groupe = $_POST["groupe"];
						}
			    	?>

			  	</div>

				<div style="float:left; border-spacing: 10px">

					<?php
						echo("<form method='POST'><p> Date <input type='date' name='date' id='date'/></p></form>");
						if(isset($_POST["date"])){
							$date = $_POST["date"];
						}
						// date_create_from_format ( "d/m/Y" , $date [, DateTimeZone "e" ] ) : DateTime // Pas sur de cette conversion
			    	?>

			  	</div>

				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Nom de la salle
			  	</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="float:left; border-spacing: 10px">

					<?php
			    	while($data_sale = mysqli_fetch_array($requete_salle)){
			    		if(isset($_POST["salle"])){
							$salle = $data_salle['salle'];
			    		}
						echo("<button class = 'dropdownitem' type = 'submit'> ".$salle." </button>");
					}
			    	?>

			  	</div>

			  	<div style="float:left; border-spacing: 10px">

					<?php
						echo('<form method="POST"><p> Heure de début <input type="time" name="hd"/></p></form>');
						if(isset($_POST['hd'])){
							$heureDebut = $_POST["hd"];
						}
						// date_create_from_format ( "H:i" , $heureDebut [, DateTimeZone "e" ] ) : DateTime // Pas sur de cette conversion
			    	?>

			  	</div>

				<div style="float:left; border-spacing: 10px">

					<?php
						echo("<form method='POST'><p> Heure de fin <input type='time' name='hf'/></p></form>");
						if(isset($_POST["hf"])){
							$heureFin = $_POST["hf"];
						}
						// date_create_from_format ( "H:i" , $heureFin [, DateTimeZone "e" ] ) : DateTime // Pas sur de cette conversion
			    	?>

			  	</div>

			</div>
			<p><input name = "submit" type="submit" value="Valider" style="float: right; width: 25%;"></p>
		</form>
	</div>
</html>