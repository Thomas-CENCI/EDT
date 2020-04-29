<head>
	<meta name=description content="Gestion de cours - ADMIN">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php 
 
$hostname ="sql7.freemysqlhosting.net:3306";
$username="sql7336475";
$password="ItBWtR3xM5";
$db="sql7336475";
$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

$SQL = ("UPDATE table SET colonne = '".$_GET['quelquechose']."', colonne = '".$_GET['quelquechose']."', colonne = '".$_GET['quelquechose']."', colonne = '".$_GET['quelquechose']."', colonne = '".$_GET['quelquechose']."' WHERE colonne = '".$_GET['quelquechose']."'");
$requete = mysql_query($SQL);

	header('Location: edt_main.php?');
	exit();
?>