<?php
	ini_set("display_errors", 1);
	ini_set("display_startup_errors", 1);
	error_reporting(E_ALL);

	$ressources = "4941";

	$source = file_get_contents("http://ade6-usmb-ro.grenet.fr/jsp/custom/modules/plannings/direct_cal.jsp?resources=".$ressources."&projectId=1&calType=ical&login=iCalExport&password=73rosav&lastDate=2030-08-14");

	$ical_array = explode("\n", $source);

	$events = array();

	foreach ($ical_array as $event) {
		list($key, $value) = array_pad(explode(":", $event), 2, null);

		if ($key == "BEGIN"){$temp_array = array();}

		$temp_array[$key] = $value;

		if ($key == "END"){$events[] = $temp_array;}
	}

	update_bd($events);
	//20200424T104128Z
	//'2021-03-06 17:33:07'
//--------------------------------------------------------------------------------------------
	function description($chaine){
		$tableauDesc = explode("\\n", $chaine);
		$tabFinal = [];
		$i = 0; 
		$j = 2;
		while ( $i == 0) {
			if($j >= count($tableauDesc)-1){$i = 1;}
			else{
					$ensemble = explode("-", $tableauDesc[$j]);
					if($ensemble[0] == 'IDU' or $ensemble[0] == 'MM' or $ensemble[0] == 'IAI'){
						$classe = $ensemble[0].'-'.$ensemble[1];
						if(count($ensemble) == 2) {
							$groupe = 'CM';
						} else {
							$groupe = $ensemble[2];
						}
						//echo "Le cours est pour la classe : ".$classe." le groupe est le suivant : ".$groupe."</br>";
						$a = [$classe,$groupe];
						array_push($tabFinal,$a);
					}
					else{

						$i = 1;
					}

					$j = $j +1;
			}
		}
	return $tabFinal;
	}
//--------------------------------------------------------------------------------------------

	function descriptionProf($chaine){
		$tableauDesc = explode("\\n", $chaine);
		$i = 0; 
		$j = 2;
		$retourne = null;
		while ( $i == 0) {
			if($j >= count($tableauDesc)-1){$i = 1;}
			else{
					$ensemble = explode("-", $tableauDesc[$j]);
					if($ensemble[0] == 'IDU' or $ensemble[0] == 'MM' or $ensemble[0] == 'IAI'){
					}
					else{
						$teste = substr($tableauDesc[$j],0,2);
						if(ctype_upper($teste)) {
							$retourne =  explode(" ", $tableauDesc[$j]);
							$i = 1;
						}
					}
					$j = $j +1;
			}
		}
	return $retourne;
	}

//--------------------------------------------------------------------------------------------
	function salle($µ, $µ2){
		$hostname = "sql7.freemysqlhosting.net:3306";
		$username="sql7336475";
		$password="ItBWtR3xM5";
		$db="sql7336475";
		$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

		$µ = explode("\\,", $µ);
		foreach ($µ as $data) {
			// 1- Importer la valeur dans la table salle si elle n'existe pas
			$req = $conn->prepare("SELECT identifiant From sql7336475.salle WHERE salle.nom like ?");
			$req->bind_param('s',$data);
			$req->execute();
			$req->bind_result($id);
			$req->fetch();
			$req->close();
			$val = $id;
			if(count($val) == 0){
				$req2 = $conn->prepare("INSERT INTO sql7336475.salle (nom) VALUES (?)");
				$req2->bind_param('s', $data);	
				$req2->execute();
				$req2->close();	
				
				$req1 = $conn->prepare("SELECT identifiant From sql7336475.salle WHERE salle.nom like ?");
				$req1->bind_param('s',$data);
				$req1->execute();
				$req1->bind_result($id1);
				$req1->fetch();
				$req1->close();
				$id = $id1;
				} else {
				}
				$req3 = $conn->prepare("INSERT INTO sql7336475.events2salle (identifiantSalle, identifiantEvents ) VALUES (?,?)");
				$req3->bind_param('ss', $id, $µ2);
				if($req3->execute()){}
				
			//}
		}

	}

//--------------------------------------------------------------------------------------------
	function convert_to_datetime($datetime){
		list($date, $time) = array_pad(explode("T", $datetime), 2, null);

		$year = substr($date, 0, -4);
		$month = substr($date, -4, -2);
		$day = substr($date, -2);

		$hour = substr($time, 0, -6);
		$min = substr($time, -6, -4);

		return $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
	}


//--------------------------------------------------------------------------------------------
	function drop_event($id){
		echo $id;
		$hostname = "sql7.freemysqlhosting.net:3306";
		$username="sql7336475";
		$password="ItBWtR3xM5";
		$db="sql7336475";

		// $hostname = "localhost:8889";
		// $username="root";
		// $password="root";
		// $db="sql7336475";
		$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

		$sql = "DELETE FROM events WHERE id=".$id;
		mysqli_query($conn, $sql);
	}

//--------------------------------------------------------------------------------------------
	function add_event($event){
		$g = description($event['DESCRIPTION']);
		$hostname = "sql7.freemysqlhosting.net:3306";
		$username="sql7336475";
		$password="ItBWtR3xM5";
		$db="sql7336475";

		$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

		$dtstart = convert_to_datetime($event['DTSTART']);
		$dtend = convert_to_datetime($event['DTEND']);

		// ----- Importation dans la table event -----
		$stmt = $conn->prepare("INSERT INTO sql7336475.events (DTSTART, DTEND, SUMMARY, LOCATION, DESCRIPTION) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param('sssss', $dtstart, $dtend, $event['SUMMARY'], $event['LOCATION'], $event['DESCRIPTION']);
		if ($stmt->execute()){
			echo 'Event added !'.'<br>';
		}
		else{
			echo "Error: ". $conn->error;
		}

		// ----- Récupération de l'indentifiant d'un utilisateurs depuis son nom et prénom -----
		$reqP4 = $conn->prepare("SELECT identifiant From sql7336475.utilisateur WHERE utilisateur.nom like ? 
		and utilisateur.prenom like ?");
		$prof = descriptionProf($event['DESCRIPTION']);
		$reqP4->bind_param('ss', $prof[0], $prof[1]);
		if($reqP4->execute()){
			$reqP4->bind_result($identifiantP);
			$reqP4->fetch();
			$reqP4->close();
		}


		// ----- Récupération de l'identifiant de l'event -----
		$reqP2 = $conn->prepare("SELECT id From sql7336475.events WHERE events.`DTSTART` like ? and events.`DTEND` like ? 
		and events.`LOCATION` like  ? ");
		$ev = '%'.$event['LOCATION'].'%';
		$reqP2->bind_param('sss', $dtstart, $dtend, $ev);
		$reqP2->execute();
		$reqP2->bind_result($id1);
		$reqP2->fetch();
		$reqP2->close();
		salle($event['LOCATION'],$id1);


		// ----- Importation dans la table inscritCours -----
		foreach ($g as $dat) {
			// ----- Récupération de l'identifiant du groupe -----
			$reqP = $conn->prepare("SELECT identifiant From sql7336475.groupe WHERE groupe.nom like ? and groupe.classe like ?");
			$reqP->bind_param('ss',$dat[1], $dat[0]);			
			if($reqP->execute()){
			$reqP->bind_result($identifiant);
			$reqP->fetch();
			$reqP->close();
			
			echo "L id de l evenement est : ".$id1." l identifiant du groupe est : ".$identifiantGroupe." et l identifiant du prof est : ".$identifiantP;
			// ----- Ajout des données dans la table inscitCours -----
			$reqP3 = $conn->prepare("INSERT INTO sql7336475.inscitCours (identifiantevents, identifiantGroupe, idProf) VALUES (?, ?, ?)");
			$reqP3->bind_param('sss', $id1, $identifiant,$identifiantP);
			if($reqP3->execute()){}
			$reqP3->close();}
		}


	}




//--------------------------------------------------------------------------------------------
	function update_bd($events){
		$hostname = "sql7.freemysqlhosting.net:3306";
		$username="sql7336475";
		$password="ItBWtR3xM5";
		$db="sql7336475";

		// $hostname = "localhost:8889";
		// $username="root";
		// $password="root";
		// $db="sql7336475";
		$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

		$sql = "SELECT * FROM sql7336475.events";
		$response = mysqli_query($conn, $sql);
		$result = mysqli_fetch_all($response, MYSQLI_ASSOC);

		date_default_timezone_set('Europe/Paris');
		$current_datetime = date('Y-m-d H:i:s');

		$all_dtstrat = array();

		foreach ($result as $bd_event) {
			$all_dtstrat[] = $bd_event['DTSTART'];

			if (strtotime($current_datetime) > strtotime($bd_event['DTEND'])){
				drop_event($bd_event['id']);
			}
		}

		foreach ($events as $event) {
			if(in_array(convert_to_datetime($event['DTSTART']), $all_dtstrat)){//Two different events but with same DTSTART
				foreach ($result as $bd_event){
					if ($bd_event['DTSTART'] == convert_to_datetime($event['DTSTART'])){
						if (!($bd_event['SUMMARY'] == $event['SUMMARY'] && $bd_event['DESCRIPTION'] == $event['DESCRIPTION']) && strtotime($current_datetime) < strtotime(convert_to_datetime($event['DTEND']) ) ){
							//Not the same event
							add_event($event);
						}
					}
				}
			}
			else if (strtotime($current_datetime) < strtotime(convert_to_datetime($event['DTEND']) ) ){
				add_event($event);
			}
		}

		echo 'Done !';
	}
?>