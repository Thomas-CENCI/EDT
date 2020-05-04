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

	$requete_sql = "SELECT DTSTART, DTEND, SUMMARY, LOCATION, DESCRIPTION FROM events WHERE DTSTART = \"2020-06-29 14:30:00\"";
	$result = mysqli_query($link, $requete_sql);

	/* numeric array */
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
	/*printf ("%s %s %s %s\n", $row[0], $row[1]);*/

	$date_debut = $row[0];
	$date_fin =$row[1];
	$titre_activite =$row[2];
	$location =$row[3];
	$description =$row[4];
	printf ("%s %s %s %s %s\n", $date_debut, $date_fin, $titre_activite, $location, $description);

	$intervalle = strtotime($date_fin)-strtotime($date_debut); /*strtotime converti une date anglaise qui est un string en timestamp ( le nombre de seconde entre la date et le 1er janvier 1970 00:00:00 GMT))*/
	/*$intervalle est en seconde*/
	$intervalle_min = $intervalle/60; /*convertit en minute*/
	$intervalle_case = $intervalle_min/15; /*convertit en nombre de case, une case est égale à 15 min*/
	echo "intervalle case : $intervalle_case";


	/* free result set */
	mysqli_free_result($result);

	/* close connection */
	mysqli_close($link);

	/*rowspan : https://www.w3schools.com/tags/tryit.asp?filename=tryhtml_td_rowspan */

?>

<style>
<?php 
include "../css/bootstrap/css/bootstrap.min.css";
include '../css/page0.css'; 
?>
</style>
  

<div class="row">
  <div class="col-lg-6">
    <h1>EDT</span></h1>
  </div>
</div>

<div class="row">
	<table id="jour">
		<?php
		    $jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
		    $rdv["Lundi"]["9:30"] = "Maths";
		    echo "<tr><th>Heure</th>";
		    for($x = 1; $x < 6; $x++){
		        echo "<th>".$jour[$x]."</th>";
		    }
		    echo "</tr>";

		    for($j = 7; $j < 20.75; $j += 0.25) {
		        echo "<tr>";
		        for($i = 0; $i <= 5; $i++) {
					if($i == 0) {
						$heure=floor($j);
						$decimal=$j-$heure;
						$min=$decimal*60;
						if ($min==0){
							$min="00";
						}
		                echo "<td class=\"time\"><div class=\"heure_content\">".$heure.":".$min."-</div></td>";
		            }
		            else if($i == 1){
						$date = strtotime($date_debut);
						$heure_cours = date('H', $date);
						$min_cours = date('i', $date);
						if($heure == $heure_cours && $min==$min_cours){
							echo "<td><div class=\"truc_jaune\" rowspan=\"$intervalle_case\"> truc </div></td>";
						}
						else{
							echo "<td><div class=\"truc\"> truc </div></td>";
						}
		            }else{
		            	echo "<td><div class=\"truc\"> truc </div></td>";
		            }

		            
		        }
		        echo "</tr>";
		    }
		    echo "<tr><td class=\"time\"><div class=\"heure_content derniere-heure\">20:45_</div></td>";
		    echo "<td><div class=\"truc\"> truc </div></td>";
		    echo "<td><div class=\"truc\"> truc </div></td>";
		    echo "<td><div class=\"truc\"> truc </div></td>";
		    echo "<td><div class=\"truc\"> truc </div></td>";
		    echo "<td><div class=\"truc\"> truc </div></td>";
		    echo "</tr>";
		?>
	</table>
</div>
		  
