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
			<tbody>
				<?php
					$array_hours = array('06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20');
					$array_min = array('00', '15', '30', '45');
					$array_day = array('1', '2', '3', '4', '5', '6', '7');

					foreach ($array_hours as $hour) {
						foreach ($array_min as $min) {
							if (array_search($min, $array_min) == 0){//Index == 0 -> hour:00
								//Row label full hour
								echo "<tr class='full-hour'>";
								echo "<td style='font-weight:bold; font-size:12px'>".$hour.":".$min."</td>";
							}
							else{
								//Row label
								echo "<tr>
												<td></td>
											";
							}

							foreach ($array_day as $day) {
								echo "<td><div id='day-".$day."-".$hour.$min."'></div> </td>";
							}
							echo "</tr>";
						}
					}
				?>
			</tbody>
		</table>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="myModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	         <input type="text" id="event_data" value=""/>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary">Save changes</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
?>

	<script>
		var numWeeks = 0;
		var current_week = ISO8601_week_no(addDays(0, numWeeks));
		var id_displayed = {};

		function php_event(){
			var dict_days = {'Mon': 1, 'Tue': 2, 'Wed': 3, 'Thu': 4, 'Fri': 5, 'Sat': 6, 'Sun': 7};
			var php_array = <?php echo json_encode($res); ?>;

			for (key in id_displayed) {
				$('#'+key).replaceWith(id_displayed[key]);
			}

			for(i in php_array){
				var dtstart = php_array[i]['DTSTART'];
				var dtend = php_array[i]['DTEND'];
				var summary = php_array[i]['SUMMARY'];
				var location = php_array[i]['LOCATION'];
				var description = php_array[i]['DESCRIPTION'];

				var nb_rows = quarters_np(dtstart, dtend);
				var week_date = ISO8601_week_no(new Date(dtstart));

				if (week_date == current_week){
					var id_nb = dict_days[String(new Date(dtstart)).split(" ")[0]];
					var date_hour = dtstart.split(" ")[1].split(":");
					var id = String("day-"+id_nb+"-"+date_hour[0]+date_hour[1]);

					id_displayed[id] = $("#"+id).clone();

					document.getElementById(id).innerHTML = summary;
  				var parent = $('#'+id).parent();
  				parent.attr('rowspan', 4);
   				$('#'+id).css('height', parent.height());
				}
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
  				var data = $(this).text();
  				var parent = $(this).parent();
  				parent.attr('rowspan', 4);
   				$(this).css('height', parent.height());

    			$("#myModal").modal('show');
     			$('input[id=event_data]').val( data );
  			});
		});

	</script>
</html>