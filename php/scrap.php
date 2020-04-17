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

		$temp_array[] = array($key => $value);

		if ($key == "END"){$events[] = $temp_array;}
	}

	print_r($events);
?>