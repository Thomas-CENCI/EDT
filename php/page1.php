<?php 
 
 echo "truc";
$hostname ="sql7.freemysqlhosting.net:3306";
$username="sql7336475";
$password="ItBWtR3xM5";
$db="sql7336475";

$link = mysqli_connect($hostname, $username, $password, $db);

/* check connection */
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}

//identifiantUtilisateur, type, statue, nomEvent, dateEvent, enseignantEvent, salleEvent, heureDebut, heureFin, groupeEvent, dateEventD, dateEventF

$requete_modification_sql = "SELECT * FROM modification ";
$result_modification = mysqli_query($link, $requete_modification_sql);
$nb_champs = mysqli_field_count($link);
//avant
/*$SQL = "INSERT INTO modification ('identifiantUtilisateur', 'nomEvent', 'dateEvent', 'enseignantEvent', 'salleEvent', 'heureDebut', 'heureFin', 'groupeEvent') VALUES ('".$_SESSION['login']."', nameEvent = '".$_GET['nom']."', dateEvent = '".$_GET['date']."', enseignantEvent = '".$_GET['enseignant']."', salleEvent = '".$_GET['salle']."', heureDebut = '".$_GET['heureDebut']."', heureFin = '".$_GET['heureFin']."', groupeEvent = '".$_GET['groupe']."')";
$requete = mysql_query($SQL);

	header('Location: edt_main.php?');
	exit();*/
?>


<head>
	<meta name=description content="Gestion de cours - ADMIN"> <!-- il voit une liste de demandes de modification et peu accepter ou nom la demande -->
	<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<h1>Demandes de modifications d'évènement </h1>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">identifiant</th>
      <th scope="col">identifiant cours</th>
      <th scope="col"> identifiantUtilisateur</th>
      <th scope="col">type</th>
      <th scope="col">statue</th>
      <th scope="col">nomEvent</th>
      <th scope="col">dateEvent</th>
      <th scope="col">enseignantEvent</th>
      <th scope="col">salleEvent</th>
      <th scope="col">heureDebut</th>
      <th scope="col">heureFin</th>
      <th scope="col">groupeEvent</th>
      <th scope="col">dateEventD</th>
      <th scope="col">dateEventF</th>
    </tr>
  </thead>
  <tbody>
  	<?php while($row = mysqli_fetch_array($result_modification, MYSQLI_NUM)): ?>
	    <tr>
	    	<th scope="row"><?=row[0];?></th>
	    	<?php for($i=1; $i<$nb_champs; $i++ ){
	      		echo "<td>$row[$i]</td>";
	    	} ?>
	    	<td>
		    	<button type="button" class="btn btn-primary">Accepter</button>
		    	<button type="button" class="btn btn-danger">Refuser</button>
	   		</td>
	    </tr>
	<?php endwhile; ?>
  </tbody>
</table>

<?php
	/* free result set */
	mysqli_free_result($result_event);

	/* close connection */
	mysqli_close($link);
?>