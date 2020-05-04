<head>
	<meta name=description content="Gestion de cours - ADMIN">
	<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php 
 
$hostname ="sql7.freemysqlhosting.net:3306";
$username="sql7336475";
$password="ItBWtR3xM5";
$db="sql7336475";
$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

$SQL = ("INSERT INTO modification ('identifiantUtilisateur', 'nomEvent', 'dateEvent', 'enseignantEvent', 'salleEvent', 'heureDebut', 'heureFin', 'groupeEvent') VALUES ('".$_SESSION['login']."', nameEvent = '".$_GET['nom']."', dateEvent = '".$_GET['date']."', enseignantEvent = '".$_GET['enseignant']."', salleEvent = '".$_GET['salle']."', heureDebut = '".$_GET['heureDebut']."', heureFin = '".$_GET['heureFin']."', groupeEvent = '".$_GET['groupe']."')";
$requete = mysql_query($SQL);

	header('Location: edt_main.php?');
	exit();
?>