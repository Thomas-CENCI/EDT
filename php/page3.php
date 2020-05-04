<head>
	<meta name=description content="Demande d'un évennement - ENSEIGNANT">
	<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php

$hostname ="sql7.freemysqlhosting.net:3306";
$username="sql7336475";
$password="ItBWtR3xM5";
$db="sql7336475";
$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

$SQL_enseignant = "SELECT identifiant FROM user WHERE type LIKE 'type de l'enseignant";
$requete_enseignant = mysqli_query($conn, $SQL_enseignant);

$SQL_salle = "SELECT identifiant FROM salles";
$requete_salle = mysqli_query($conn, $SQL_salle);

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
			<div>
				<div style="float:left">

					<?php
						echo("<form method='post' action='#'>
								<p> Nom de l'évennement <input name='nom' id='name'/></p>
							  </form>");
						$nom = $_POST['nom']
			    	?>

			  	</div>

				<div style="float:right">

					<?php
						echo('<form method="post" action="#">
								<p> Date <input type="date" name="date" id="dd"/></p>
							  </form>');

						$date = $_POST['date'];
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

				<div style="float:right">

					<?php
						echo('<form method="post" action="#">
								<p>  
									Heure de fin <input type="time" name="hf">
								</p>
						</form>');
						$heureFin = $_POST['hf'];
			    	?>

			  	</div>

				<div style="float:right">

					<?php
						echo('<form method="post" action="#">
								<p>  
									Heure de début <input type="time" name="hd">
								</p>
						</form>');
						$heureDebut = $_POST['hd'];
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