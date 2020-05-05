<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../css/page4.css">
	</head>

	<body>
		<div class="mb-2" style="text-align: center;">
			<button type="button" class="btn btn-dark" id='btn-'><</button>
			<button type="button" class="btn btn-dark" id='btn_week' disabled></button>
			<button type="button" class="btn btn-dark" id='btn+'>></button>
		</div>

		<div class="table-div table-responsive" style="height: 675px">	
			<table class="table" cellpadding="24px">
				<thead class="thead-dark">
					<tr>
						<th scope="col" style="text-align: center;">Heure</th>
						<th scope="col" style="text-align: center;">Lundi</th>
						<th scope="col" style="text-align: center;">Mardi</th>
						<th scope="col" style="text-align: center;">Mercredi</th>
						<th scope="col" style="text-align: center;">Jeudi</th>
						<th scope="col" style="text-align: center;">Vendredi</th>
						<th scope="col" style="text-align: center;">Samedi</th>
						<th scope="col" style="text-align: center;">Dimanche</th>
					</tr>
				</thead>
				<tbody id='table_body'>
				</tbody>
			</table>
		</div>

		<div class="modal fade" tabindex="-1" role="dialog" id="EventModal">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Modification évènement</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
			    <div class="modal-body">
			     	<div class="form-group">
							<form id="edit_event_form" method="POST" action="/EDT/php/edit_event.php">
								<label class="col-form-label" for="event_dtstart">Début </label>
				      	<input class="form-control" type="text" id="event_dtstart" placeholder="Début" value=""/>

								<label class="col-form-label" for="event_dtend">Fin </label>
				      	<input class="form-control" type="text" id="event_dtend" value="" placeholder="Fin"/>

								<label class="col-form-label" for="event_summary">Résumé </label>
				      	<input class="form-control" type="text" id="event_summary" value="" placeholder="Résumé"/>

								<label class="col-form-label" for="event_location">Localisation </label>
				      	<input class="form-control" type="text" id="event_location" value="" placeholder="Localisation"/>

								<label class="col-form-label" for="event_description">Description </label>
				      	<input class="form-control" type="text" id="event_description" value="" placeholder="Description"/>
			  			</form>
			  		</div>
			    </div>
		      <div class="modal-footer">
		        <button id="edit_event_submit" type="button" class="btn btn-primary">Modifier</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
		      </div>
		    </div>
		  </div>
		</div>
	</body>
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

	$sql = "SELECT DTSTART, DTEND, SUMMARY, LOCATION, DESCRIPTION FROM events";
	$result = mysqli_query($link, $sql);
	$res = $result -> fetch_all(MYSQLI_ASSOC);

	function create_tablebody(){
		$array_hours = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23');
		$array_min = array('00', '15', '30', '45');
		$array_day = array('1', '2', '3', '4', '5', '6', '7');

		$html = "";

		foreach ($array_hours as $hour) {
			foreach ($array_min as $min) {
				if (array_search($min, $array_min) == 0){//Index == 0 -> hour:00
					//Row label full hour
					$html = $html." "."<tr class='full-hour'>";
					$html = $html." "."<td style='font-weight:bold;'>".$hour.":".$min."</td>";
				}
				else{
					//Row label
					$html = $html." "."<tr>
									<td></td>";
				}

				foreach ($array_day as $day) {
					$html = $html." "."<td id='td-".$day."-".$hour.$min."'><div id='div-".$day."-".$hour.$min."'></div> </td>";
				}
				$html = $html." "."</tr>";
			}
		}
	return $html;
	}
?>

	<script>
		var numWeeks = 0;
		var current_week = ISO8601_week_no(addDays(0, numWeeks));
		var php_array = <?php echo json_encode($res); ?>;

		function reset_tbody(){$('#table_body').html(<?php echo json_encode(create_tablebody()); ?>);}

		function display_events(){
			reset_tbody();
			var dict_days = {'Mon': 1, 'Tue': 2, 'Wed': 3, 'Thu': 4, 'Fri': 5, 'Sat': 6, 'Sun': 7};

			for(i in php_array){
				var dtstart = php_array[i]['DTSTART'];
				var dtend = php_array[i]['DTEND'];
				var summary = php_array[i]['SUMMARY'];
				var location = php_array[i]['LOCATION'];
				var description = php_array[i]['DESCRIPTION'];

				var nb_rows = quarters_np(dtstart, dtend);
				var week_date = ISO8601_week_no(new Date(dtstart));

				if (week_date == current_week){
					var id_day = dict_days[String(new Date(dtstart)).split(" ")[0]];
					var date_hour = dtstart.split(" ")[1].split(":");
					var id = String("div-"+id_day+"-"+date_hour[0]+date_hour[1]);

					var html = "<div style='font-weight: bold'>"+summary+"</div><br>Début : <div>"+dtstart+"</div>Fin : <div>"+dtend+"</div><br>Localisation : <div>"+location+"</div><br>Description : <div>"+description+"</div>";
					$('#'+id).append(html);

   				delete_td(id, id_day, nb_rows);

  				$('#'+id).parent().attr('rowspan', nb_rows);
   				$('#'+id).css('height', 17*nb_rows);
				}
			}
			$('.table-div').animate({scrollTop:$('#'+first_event()).offset().top}, 'slow')
		}

		function first_event(){
			return $('td>div:not(:empty):first').attr('id');
		}

		function delete_td(id, id_day, nb_rows){
				var i = 0;
				var current_td = $('#'+id).parent();

			while (i < nb_rows){
				var current_tr = current_td.parent().children('td');
  			var next_td = current_tr.parent().closest('tr').next('tr').find("td[id^='td-"+id_day+"-']");

  			if ($(current_td).children('div').attr('id') != id){
  				$(current_td).remove();
  			}

  			current_td = next_td;
				i++;
			}
		}

		function quarters_np(dtstart, dtend){
			var tstart = new Date(dtstart);
			var tend = new Date(dtend);

			var timeStart = tstart.getMinutes() + 60*tstart.getHours();
			var timeEnd = tend.getMinutes() + 60*tend.getHours();

			return (timeEnd - timeStart)/15;
		}

		function ISO8601_week_no(dt) {
		   var tdt = new Date(dt.valueOf());
		   var dayn = (dt.getDay() + 6) % 7;
		   tdt.setDate(tdt.getDate() - dayn + 3);
		   var firstThursday = tdt.valueOf();
		   tdt.setMonth(0, 1);
		   if (tdt.getDay() !== 4) 
		     {
		    tdt.setMonth(0, 1 + ((4 - tdt.getDay()) + 7) % 7);
		      }
		   return 1 + Math.ceil((firstThursday - tdt) / 604800000);
		 }

		function addDays(numDays, numWeeks) {
			dateObj = new Date();
			dateObj.setDate(dateObj.getDate() + numDays + numWeeks*7 );
			return dateObj;
		}

		document.getElementById('btn+').onclick = function() {
			numWeeks += 1;
			current_week = ISO8601_week_no(addDays(0, numWeeks));
			update_table();
		}

		document.getElementById('btn-').onclick = function() {
			numWeeks += -1;
			current_week = ISO8601_week_no(addDays(0, numWeeks));
			update_table();
		}

	function update_table(){
		document.getElementById("btn_week").innerHTML = "Semaine "+current_week;
		display_events();
	};

	$('.table').click(function(){
		$('div[id^=div-]').click(function(){
			var children = $(this).children('div');
			$("#EventModal").modal('show');
			$('input[id=event_summary]').val( $(children[0]).text() );
			$('input[id=event_dtstart]').val( $(children[1]).text() );
			$('input[id=event_dtend]').val( $(children[2]).text() );
			$('input[id=event_location]').val( $(children[3]).text() );
			$('input[id=event_description]').val( $(children[4]).text() );
		})
	});

	$("#edit_event_submit").click(function() {
		$("#edit_event_form").submit();
	});

	$(document).ready(update_table());
	</script>
</html>