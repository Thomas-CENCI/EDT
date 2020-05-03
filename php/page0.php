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
		  
