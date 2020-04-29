<head>
	<meta name=description content="Demdander d'un évennement - ENSEIGNANT">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php

$hostname ="sql7.freemysqlhosting.net:3306";
$username="sql7336475";
$password="ItBWtR3xM5";
$db="sql7336475";
$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

$SQL_nom = ("SELECT identifiant FROM cours");
$requete_nom = mysql_query($SQL_nom);

$SQL_module = ("SELECT identifiant FROM modules");
$requete_module = mysql_query($SQL_module);

// $duree = 

$SQL_enseignant = ("SELECT identifiant FROM user WHERE type LIKE 'type de l'enseignant");
$requete_enseignant = mysql_query($SQL_enseignant);

$SQL_salle = ("SELECT identifiant FROM salles");
$requete_salle = mysql_query($SQL_salle);

// $date = 

$SQL_groupe = ("SELECT identifiant FROM groupe");
$requete_groupe = mysql_query($SQL_groupe);

?>

<html>
	<head>
		<h1 style="text-align: center;">Demande de création d'un évennement - ENSEIGNANT</h1>
		<meta charset = 'utf-8'>
		<link rel='stylesheet' href='page3.css'>
	</head>
	<div>
		<nav>
			<ul>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Nom de l'évennement
				  	</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

						<?php
						while($data_nom = mysql_fetch_array($requete_nom)){
							$nom = $data_nom['nom'];
							echo("<a class = 'dropdownitem' href = '#'> ".$nom." </a>")
				    	?>

				  	</div>
				</div>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Nom du module
				  	</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

						<?php
				    	while($data_module = mysql_fetch_array($requete_module)){
							$module = $data_module['nom'];
							echo("<a class = 'dropdownitem' href = '#'> ".$module." </a>")
				    	?>

				  	</div>
				</div>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Durée de l'évennement
				  	</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

						<?php
						echo("<a class = 'dropdownitem' href = '#'> ".$duree." </a>")
				    	?>

				  	</div>
				</div>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Nom de l'enseignant
				  	</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

						<?php
				    	while($data_enseignant = mysql_fetch_array($requete_enseignant)){
							$enseignant = $data_enseignant['nom'];
							echo("<a class = 'dropdownitem' href = '#'> ".$enseignant." </a>")
				    	?>

				  	</div>
				</div>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Nom de la salle
				  	</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

						<?php
				    	while($data_sale = mysql_fetch_array($requete_salle)){
							$salle = $data_salle['nom'];
							echo("<a class = 'dropdownitem' href = '#'> ".$salle." </a>")
				    	?>

				  	</div>
				</div>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Date de l'évennement
				  	</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

						<?php
						echo("<a class = 'dropdownitem' href = '#'> ".$date." </a>")
				    	?>

				  	</div>
				</div>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Groupe(s) concerné(s)
				  	</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

						<?php
				    	while($data_groupe = mysql_fetch_array($requete_groupe)){
							$groupe = $data_groupe['nom'];
							echo("<a class = 'dropdownitem' href = '#'> ".$salle." </a>")
				    	?>

				  	</div>
				</div>
			</ul>
		</nav>
	</div>

	<?php
		// récupérer les données renseignées.
	?>

	<div>
		<h1 style="text-align: center"></h1>
		<div>
			<form id='capteur_f' action='page1.php' method='GET' onsubmit='return validate()'>
				<input type="text" name="nom" id="nom" readonly="readonly" value=<?php echo $nom; ?>>
				<input type="text" name="module" id="module" value=<?php echo $module; ?>>
				<input type="text" name="durée" id="durée" value=<?php echo $duree; ?>>
				<input type="text" name="enseignant" id="enseignant" value=<?php echo $enseignant; ?>>
				<input type="text" name="date" id="date" value=<?php echo $date; ?>>
				<input type="text" name="groupe" id="groupe" value=<?php echo $groupe; ?>>
				<p><input type="submit" value="Valider" style="float: right; width: 25%;"></p>
			</form>
	</div>
</html>