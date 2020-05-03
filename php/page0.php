<style>
<?php 
include "bootstrap/css/bootstrap.min.css";
include 'page0.css'; ?>
</style>
  

<div class="row">

  <div class="col-lg-6">
    <h1>EDT</span></h1>
  </div>

</div>

<style type="text/css">
caption /* Titre du tableau */
{
   margin: auto; /* Centre le titre du tableau */
   /*font-family: Arial, Times, "Times New Roman", serif;*/
   font-weight: bold;
   font-size: 1.2em;
   color: #009900;
   margin-bottom: 20px;
}

table /* Le tableau en lui-même */
{
   margin: auto;
   border: 4px outset green;
   border-collapse: collapse;
   width:100%;
}
th /* Les cellules d'en-tête */
{
   background-color: #006600;
   color: white;
   font-size: 1.1em;
   /*font-family: Arial, "Arial Black", Times, "Times New Roman", serif;*/
   border:1px solid red;
   text-align: center;
}

td /* Les cellules normales */
{
   border: 1px solid black;
   /*font-family: "Comic Sans MS", "Trebuchet MS", Times, "Times New Roman", serif;*/
   text-align: center;
   padding: 0px;
}
td.time
{
    width:5%;
    border:1px solid white;
    text-align: right;
}

td.content{
}

.truc{
	background-color: red;
}

div.jour{
	padding-left: 0px;
}

table#heure td{
	border : 1px solid white;
	text-align: right; 
}
div.heure_content{
	position:relative;
	top:11px;
}

div.derniere-heure{
	position:relative;
	top:5px;
}

div.premiere-heure{
	position:relaitve;
	top:0px;
}

</style>

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
		  
