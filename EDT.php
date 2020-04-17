<!DOCTYPE HTML>

<html>

  <head>
    <title></title>
    <meta content="info">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="EDT.css" />
  </head>
  
  <body>
  
  <div id="fond">
  
    <div id="titre">
      <h1 style="text-align: center;">EDT</span>
    </div>
  
    <div id="menu">

    </div>
  
    <div id="contenu">
    	<style type="text/css">
        caption /* Titre du tableau */
        {
           margin: auto; /* Centre le titre du tableau */
           font-family: Arial, Times, "Times New Roman", serif;
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
           font-family: Arial, "Arial Black", Times, "Times New Roman", serif;
           border:1px solid red;
        }
 
        td /* Les cellules normales */
        {
           border: 1px solid black;
           font-family: "Comic Sans MS", "Trebuchet MS", Times, "Times New Roman", serif;
           text-align: center;
           padding: 5px;
        }
        td.time
        {
            width:5%;
        }
    	</style>
		<table>
			<?php
			    $jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
			    $rdv["Lundi"]["9:30"] = "Maths";
			    echo "<tr><th>Heure</th>";
			    for($x = 1; $x < 6; $x++)
			        echo "<th>".$jour[$x]."</th>";
			    echo "</tr>";
			    for($j = 7; $j < 21; $j += 0.25) {
			        echo "<tr>";
			        for($i = 0; $i < 5; $i++) {
			            if($i == 0) {
			                $heure = str_replace(".25", ":15", $j);
			                $heure = str_replace(".5", ":30", $j); /* Ne fonctionne pas */
			                $heure = str_replace(".75", ":45", $j);
			                echo "<td class=\"time\">".$heure."</td>";
			            }
			            echo "<td>";
			            if(isset($rdv[$jour[$i+1]][$heure])) {
			                echo $rdv[$jour[$i+1]][$heure];
			            }
			            echo "</td>";
			        }
			        echo "</tr>";
			    }
			?>
		</table>

    </div>
 
  </div>
  
  </body>
</html>  
  