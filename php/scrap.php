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

	function convert_to_datetime($datetime){
		list($date, $time) = array_pad(explode("T", $datetime), 2, null);

		$year = substr($date, 0, -4);
		$month = substr($date, -4, -2);
		$day = substr($date, -2);

		$hour = substr($time, 0, -6);
		$min = substr($time, -6, -4);

		return $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
	}

	function drop_event($id){
		echo $id;
		$hostname = "localhost:8889";
		$username="root";
		$password="root";
		$db="gosselre";
		$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

		$sql = "DELETE FROM events WHERE id=".$id;
		mysqli_query($conn, $sql);
	}

	function add_event($event){
		$hostname = "localhost:8889";
		$username="root";
		$password="root";
		$db="gosselre";
		$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

		$dtstart = convert_to_datetime($event['DTSTART']);
		$dtend = convert_to_datetime($event['DTEND']);

		$stmt = $conn->prepare("INSERT INTO gosselre.events (DTSTART, DTEND, SUMMARY, LOCATION, DESCRIPTION) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param('sssss', $dtstart, $dtend, $event['SUMMARY'], $event['LOCATION'], $event['DESCRIPTION']);

		if ($stmt->execute()){
			echo 'Event added !'.'<br>';
		}
		else{
			echo "Error: ". $conn->error;
		}
	}

	function update_bd($events){
		$hostname = "localhost:8889";
		$username="root";
		$password="root";
		$db="gosselre";
		$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');

		$sql = "SELECT * FROM gosselre.events";
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
			if(in_array(convert_to_datetime($event['DTSTART']), $all_dtstrat)){
				foreach ($result as $bd_event){
					if ($bd_event['DTSTART'] == convert_to_datetime($event['DTSTART'])){
						if (!($bd_event['SUMMARY'] == $event['SUMMARY'] && $bd_event['DESCRIPTION'] == $event['DESCRIPTION'])){
							//Not the same event
							add_event($event);
						}
					}
				}
			}
			else{
				add_event($event);
			}
		}

		echo 'Done !';
	}
?>