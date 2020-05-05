<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../css/page4.css">
	</head>

	<div class="mb-2" style="text-align: center;">
		<button type="button" class="btn btn-dark" id='btn-'><</button>
		<button type="button" class="btn btn-dark" id='btn_week' disabled></button>
		<button type="button" class="btn btn-dark" id='btn+'>></button>
	</div>


	<div style="height: 600px; overflow:auto">	
		<table class="table">
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
		$array_hours = array('06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20');
		$array_min = array('00', '15', '30', '45');
		$array_day = array('1', '2', '3', '4', '5', '6', '7');

		$html = "";

		foreach ($array_hours as $hour) {
			foreach ($array_min as $min) {
				if (array_search($min, $array_min) == 0){//Index == 0 -> hour:00
					//Row label full hour
					$html = $html." "."<tr class='full-hour'>";
					$html = $html." "."<td style='font-weight:bold; font-size:12px; height:20px'>".$hour.":".$min."</td>";
				}
				else{
					//Row label
					$html = $html." "."<tr>
									<td></td>
								";
				}

				foreach ($array_day as $day) {
					$html = $html." "."<td id='".$day.$hour.$min."'><div id='day-".$day."-".$hour.$min."'></div> </td>";
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

		function php_event(){
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

				if (nb_rows == 0){
					nb_rows = 0.5;//30min
				}

				if (week_date == current_week){
					var id_nb = dict_days[String(new Date(dtstart)).split(" ")[0]];
					var date_hour = dtstart.split(" ")[1].split(":");
					var id = String("day-"+id_nb+"-"+date_hour[0]+date_hour[1]);

					delete_rows(id, nb_rows);

					var html = "<p style='font-weight: bold'>"+summary+"</p><p>Début : "+dtstart+"</p><p>Fin : "+dtend+"</p><p>Localisation : "+location+"</p><p> Description : "+description+"</p>";
					$('#'+id).append(html);

  				var parent = $('#'+id).parent();
  				parent.attr('rowspan', nb_rows*4);
   				$('#'+id).css('height', parent.height());
   				$('#'+id).attr('data-rowspan', nb_rows*4);

				}
			}
		}

		function delete_rows(id, nb_rows){
				var i = 0;
				var current_td = $('#'+id).parent();

			while (i < nb_rows*4){
				var current_tr = current_td.parent().children(('td'));
  			var index = current_tr.index(current_td);
  			var next_td = current_tr.closest('tr').next('tr').find('td:eq('+index+')');

  			if ($(current_td).children('div').attr('id') != id){
  				$(current_td).remove();
  			}
  			current_td = next_td;
				i++;
			}
		}

		function quarters_np(dtstart, dtend){
			var timeStart = new Date(dtstart).getHours();
			var timeEnd = new Date(dtend).getHours();

			return timeEnd - timeStart;
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
			document.getElementById("btn_week").innerHTML = "Semaine "+current_week;
			php_event();
		}

		document.getElementById('btn-').onclick = function() {
			numWeeks += -1;
			current_week = ISO8601_week_no(addDays(0, numWeeks));
			document.getElementById("btn_week").innerHTML = "Semaine "+current_week;
			php_event();
		}

		$(document).ready(function(){
				php_event();

				document.getElementById("btn_week").innerHTML = "Semaine "+current_week;

  			$("div[id^='day-']").click(function(){
  				var children = $(this).children();

    			$("#EventModal").modal('show');
     			$('input[id=event_summary]').val( $(children[0]).text() );
     			$('input[id=event_dtstart]').val( $(children[1]).text().split(': ')[1] );
     			$('input[id=event_dtend]').val( $(children[2]).text().split(': ')[1] );
     			$('input[id=event_location]').val( $(children[3]).text().split(': ')[1] );
     			$('input[id=event_description]').val( $(children[4]).text().split(': ')[1] );
  			});

			$("#edit_event_submit").click(function() {
				$("#edit_event_form").submit();
			});

			$('.table tr').css('height', '5px');

	});

	</script>
</html>