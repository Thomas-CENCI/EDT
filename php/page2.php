<?php

$hostname ="sql7.freemysqlhosting.net:3306";
$username="sql7336475";
$password="ItBWtR3xM5";
$db="sql7336475";
$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

$SQL_salle = "SELECT salle.nom FROM salle";
$SQL_enseignant = "SELECT utilisateur.nom, utilisateur.prenom FROM utilisateur WHERE utilisateur.type = 2";
$SQL_groupe = "SELECT groupe.nom FROM groupe";

$response_salle = mysqli_query($conn, $SQL_salle);
$requete_salle = mysqli_fetch_all($response_salle, MYSQLI_ASSOC);
$response_enseignant = mysqli_query($conn, $SQL_enseignant);
$requete_enseignant = mysqli_fetch_all($response_enseignant, MYSQLI_ASSOC);
$response_groupe = mysqli_query($conn, $SQL_groupe);
$requete_groupe = mysqli_fetch_all($response_groupe, MYSQLI_ASSOC);

if(isset($_POST["submit"])){
	$nom = $_POST["nom"];
	$enseignant = $_POST["enseignant"];
	$groupe = $_POST["groupe"];
	$salle = $_POST["salle"];
	$date = $_POST["date"];
	$heureDebut = $_POST["hd"];
	$heureFin = $_POST["hf"];
	$description = $_POST["description"];
	$dateD = $_POST["date"]." ".$heureDebut.":00";
	$dateF = $_POST["date"]." ".$heureFin.":00";


	$SQL = "INSERT INTO modification (type, identifiantUtilisateur, nomEvent, enseignantEvent, salleEvent, groupeEvent, descriptionEvent,dateEventD,dateEventF)
			VALUES (1,'".$_SESSION['login']."', '".$nom."', '".$enseignant."', '".$salle."', '".$groupe."', '".$description."','".$dateD."','".$dateF."')";

	mysqli_query($conn, $SQL);

	echo "<div class='alert alert-success' role='alert'>Demande envoyée</div>";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name=description content="Demande de création d'un événement">
		<link rel="stylesheet" href="../css/page2.css"> <!-- il faudra changer avec la page0.css je pense -->
	</head>
	<div class="basic_form">
		<form  method='POST' action='../php/edt_main.php?page=2'>

			<div>
				<label for='nom'>Evénement : </label></br>
				<input type='text' name='nom' id='nom' class='form-control'/></br>
			</div>
			<div>
			  	<label for="enseignant">Enseignant : </label></br>
				<select class="form-control"  id="enseignant" name="enseignant">
					<?php foreach($requete_enseignant as $enseignant){echo "<option  value='".$enseignant['nom']." + ".$enseignant['prenom']."'>".$enseignant['nom']." ".$enseignant['prenom']."</option>";} ?>
				</select>
			</div>
			<div>
			  	<label for="groupe">Groupe : </label></br>
				<select class="form-control"  id="groupe" name="groupe">
					<?php foreach($requete_groupe as $groupe){echo "<option  value='".$groupe['nom']."'>".$groupe['nom']."</option>";} ?>
				</select>
			</div>
			<div>
				<label for='date'>Date : </label></br>
				<input type='date' name='date' id='date' class='form-control'/></br>
			</div>
			<div>
			<div>
			  	<label for="salle">Salle : </label></br>
				<select class="form-control"  id="salle" name="salle">
					<?php foreach($requete_salle as $salle){echo "<option  value='".$salle['nom']."'>".$salle['nom']."</option>";} ?>
				</select>
			</div>
			</div>
			<div>
				</br><label for='hd'>Début : </label></br>
				<input class='form-control' type='time' name='hd' id='hd'/></br>
			</div>
			<div>
				<label for='hf'>Fin : </label></br>
				<input class='form-control' type='time' name='hf' id='hf'/></br>
			</div>
			<div>
				<label for='description'>Description :</label></br>
				<input class='form-control' type='text' name='description' id='description'/></br>
		  	</div>

		  	<div class="modal-footer">
				<button class="btn btn-primary" name="submit" type="submit" value="Valider">Valider</button>
			</div>
		</form>
	</div>
</html>

