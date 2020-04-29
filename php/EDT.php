<?php
session_start();
 ?>
<!DOCTYPE HTML>

<html>

  <head>
    <title></title>
    <meta content="info">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="EDT.css" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>
  
  <body>

      <div class="row">
          <div class="col-lg-6">
            <ul id="menu-accordeon">
             <li><a href="#">|||</a>
            <ul>
               <li><a href="#">lien sous menu 1</a></li>
               <li><a href="#">lien sous menu 2</a></li>
               <li><a href="#">lien sous menu 3</a></li>
               <li><a href="#">lien sous menu 4</a></li>
            </ul></ul></li>
          </div>

          <div class="col-lg-6">
            <h1>EDT</span></h1>
          </div>

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
          $hostname = "localhost:8889";
          $username="root";
          $password="";
          $db="name";
          $conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');
          
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
  