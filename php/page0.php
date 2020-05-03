<?php
	$hostname ="sql7.freemysqlhosting.net:3306";
	$username="sql7336475";
	$password="ItBWtR3xM5";
	$db="sql7336475";
	$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

	$requete_sql = "SELECT DTSTART, DTEND, SUMMARY, LOCATION, DESCRIPTION FROM events WHERE DTSTART LIKE '%06-29%";

	$result = mysqli_query($conn, $requete_sql);
	$fetch_array = mysqli_fetch_row($result);
	echo print_r($fetch_array);
	$date_debut = $fetch_array[0];
	$date_fin =$fetch_array[1];
	$titre_activite =$fetch_array[2];
	$location =$fetch_array[3];
	$description =$fetch_array[4];

	$intervalle = strtotime($date_fin)-strtotime($date_debut); /*strtotime converti une date anglaise qui est un string en timestamp ( le nombre de seconde entre la date et le 1er janvier 1970 00:00:00 GMT))*/
	echo $description;
	/*$intervalle est en seconde*/
	$intervalle_min = $intervalle/60; /*convertit en minute*/
	$intervalle_case = $intervalle_min/15; /*convertit en nombre de case, une case est égale à 15 min*/
	echo $intervalle_case;

	/*rowspan : https://www.w3schools.com/tags/tryit.asp?filename=tryhtml_td_rowspan */
?>

<style>
<?php 
include "bootstrap/css/bootstrap.min.css";
include 'page0.css'; 
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
		    for($x = 1; $x < 6; $x++)
		        echo "<th>".$jour[$x]."</th>";
		    echo "</tr>";

		    for($j = 7; $j < 20.75; $j += 0.25) {
		        echo "<tr>";
		        for($i = 0; $i < 5; $i++) {
					if($i == 0) {
						$heure=floor($j);
						$decimal=$j-$heure;
						$min=$decimal*60;
						if ($min==0){
							$min="00";
						}
		                echo "<td class=\"time\"><div class=\"heure_content\">".$heure.":".$min."-</div></td>";
		            }

		            /*if(isset($rdv[$jour[$i+1]][$heure])) {
		                echo $rdv[$jour[$i+1]][$heure];
		            }*/
		            echo "<td><div class=\"truc\"> truc </div></td>";
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
		  
