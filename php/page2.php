<?php

$hostname ="sql7.freemysqlhosting.net:3306";
$username="sql7336475";
$password="ItBWtR3xM5";
$db="sql7336475";
$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

$SQL_salle = "SELECT salle.nom FROM salle";
$response = mysqli_query($conn, $SQL_salle);
$requete_salle = mysqli_fetch_all($response, MYSQLI_ASSOC);

if(isset($_POST["submit"])){
	$nom = $_POST["nom"];
	$enseignant = $_POST["enseignant"];
	$groupe = $_POST["groupe"];
	$salle = $_POST["salle"];
	$date = $_POST["date"];
	$heureDebut = $_POST["hd"];
	$heureFin = $_POST["hf"];
	$description = $_POST["description"];


	$SQL = "INSERT INTO modification (identifiantUtilisateur, type, nomEvent, dateEvent, enseignantEvent, salleEvent, heureDebut, heureFin, groupeEvent, descriptionEvent)
			VALUES ('".$_SESSION['login']."', 1, '".$nom."', '".$date."', '".$enseignant."', '".$salle."', '".$heureDebut."', '".$heureFin."', '".$groupe."', '".$description."')";
	mysqli_query($conn, $SQL);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name=description content="Demande de création d'un événement">
	</head>
	<form  method='POST' action='/EDT/php/edt_main.php?page=2'>
	  	<div style="position:relative; border-spacing: 10px">

			<?php
				echo "<label for='nom'>Nom de l'évènement : </label>";
				echo "<input type='text' name='nom' id='nom'/>";
	    	?>

	  	</div>

	  	<div style="position:relative; border-spacing: 10px">

			<?php
				echo "<label for='enseignant'>Nom de l'enseignant : </label>";
				echo "<input type='text' name='enseignant' id='enseignant'/>";
	    	?>

	  	</div>

	  	<div style="position:relative; border-spacing: 10px">

			<?php
				echo "<label for='groupe'>Groupe(s) concerné(s) : </label>";
				echo "<input type='text' name='groupe' id='groupe'/>";
	    	?>

	  	</div>

	  	<div style="position:relative; border-spacing: 10px">

			<?php
				echo "<label for='date'>Date : </label>";
				echo "<input type='date' name='date' id='date'/>";

				// date_create_from_format ( "d/m/Y" , $date [, DateTimeZone "e" ] ) : DateTime // Pas sur de cette conversion
	    	?>

	  	</div>

	  	<label for="salle">Nom de la salle : </label>
		<select class="form-control" id="salle" name="salle">
			<?php
			foreach($requete_salle as $salle){
				echo "<option  value='".$salle['nom']."'>".$salle['nom']."</option>";
			}
	    	?>
		</select>

	  	<div style="position:relative; border-spacing: 10px">

			<?php
				echo "<label for='hd'>Heure de début : </label>";
				echo "<input type='time' name='hd' id='hd'/>";

				// date_create_from_format ( "H:i" , $heureDebut [, DateTimeZone "e" ] ) : DateTime // Pas sur de cette conversion
	    	?>

	  	</div>

	  	<div style="position:relative; border-spacing: 10px">
			<?php
				echo "<label for='hf'>Heure de fin : </label>";
				echo "<input type='time' name='hf' id='hf'/>";
				// date_create_from_format ( "H:i" , $heureFin [, DateTimeZone "e" ] ) : DateTime // Pas sur de cette conversion
	    	?>
	  	</div>

	  	<div style="position:relative; border-spacing: 10px">
			<?php
				echo "<label for='description'>Description : </label>";
				echo "<input type='text' name='description' id='description'/>";
	    	?>
	  	</div>

		<input name = "submit" type="submit" value="Valider" style="float: right; width: 25%;"></input>
	</form>
</html>