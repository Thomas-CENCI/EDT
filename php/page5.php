<?php
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
	$requete = $_GET["barre_de_recherche"];

	$requete_sql = "SELECT DTSTART, DTEND, SUMMARY, LOCATION, DESCRIPTION, id FROM events WHERE (DTSTART LIKE '%$requete%') OR (DTEND LIKE '%$requete%') OR (SUMMARY LIKE '%$requete%') OR (LOCATION LIKE '%$requete %') OR (DESCRIPTION LIKE '%$requete%')";
	$result = mysqli_query($link, $requete_sql);
?>

<div class="row">
  <div class="col-lg-8">
    <h1>Résultat de la recherche : <?=$requete;?></span></h1>
  </div>
</div>

<div class="container">
<?php $i=0; ?>
<?php while($row = mysqli_fetch_array($result, MYSQLI_NUM)): ?> <!-- afficher message quand il n'y pas de résultat-->
	<?php if($i==0): ?>
		<div class="row">
	<?php endif; ?>
	<div class="col-lg-4">
		<div class="card" style="width: 18rem; margin: 10px;">
			<?php $module = substr($row[2],0, 7); ?>
		  <?php echo "<img src=\"../image/$module.jpg\" class=\"card-img-top\" alt=\"$module\">"; ?> <!-- on modifie l'image selon le module-->
		  <div class="card-body">
		    <h5 class="card-title"> <?=$row[2]?> </h5>
		    <?php $row[4] = str_replace('\\n', ' ', $row[4]); ?>
		    <p class="card-text"><?=$row[4]?></p>
		    <a href="#" class="btn btn-primary">Plus d'info</a>
		  </div>
		</div>
	</div>
	<?php $i=$i+1; ?>
	<?php if($i==3):
		$i=0;
		echo "</div>";
 	endif; ?>

<?php endwhile; ?>

</div>

<?php
		/* free result set */
		mysqli_free_result($result);

		/* close connection */
		mysqli_close($link);
?>