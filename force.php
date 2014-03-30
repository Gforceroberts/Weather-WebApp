<?php include('connect.php'); ?>
<html>
      <?php
		//Get the url values
		 $temp = (empty($_GET['temp']) ? 0 : $_GET['temp']);
		 $pressure = (empty($_GET['pressure']) ? 0 : $_GET['pressure']);
		 $humidity = (empty($_GET['humidity']) ? 0 : $_GET['humidity']);
		 $rain = (empty($_GET['rain']) ? 0 : $_GET['rain']);
		 $dptemp = (empty($_GET['dptemp']) ? 0 : $_GET['dptemp']);
		 $balt = (empty($_GET['balt']) ? 0 : $_GET['balt']);
		 $winddir = (empty($_GET['winddir']) ? 0 : $_GET['winddir']);
		 $windspeed = (empty($_GET['windspeed']) ? 0 : $_GET['windspeed']);
				 
		if ($opendb)
		{
			if(!empty($temp))
			{
				date_default_timezone_set('Africa/Johannesburg');
				$date = date('Y-m-d H:i:s');

				$sql = "INSERT INTO `mydata` (`date`,`temp`,`pressure`,`humidity`,`rain`, `dptemp`,`balt`,`winddir`,`windspeed`) VALUES ('$date', $temp, $pressure, $humidity, $rain, $dptemp, $balt, $winddir, $windspeed);";
				print $sql;
				mysql_query($sql) or die(mysql_error());

				//Display table
				$SQL = "SELECT * FROM mydata order by date desc";
				$result = mysql_query($SQL);

				?>
				<table border="1">
				<tr>
					<td>Date</td>
					<td>Temp</td>
					<td>Pressure</td>
					<td>Humidity</td>
					<td>Rain</td>
					<td>DP Temp</td>
					<td>Altitude</td>
					<td>Wind Dir</td>
					<td>Wind Speed</td>
				</tr>
				<?php

				while ( $db_field = mysql_fetch_assoc($result) ) {
				print '<tr>';
					print '<td>' . $db_field['date'] . "</td>";
					print '<td>' . $db_field['temp'] . "</td>";
					print '<td>' . $db_field['pressure'] . "</td>";
					print '<td>' . $db_field['humidity'] . "</td>";
					print '<td>' . $db_field['rain'] . "</td>";
					print '<td>' . $db_field['dptemp'] . "</td>";
					print '<td>' . $db_field['balt'] . "</td>";
					print '<td>' . $db_field['winddir'] . "</td>";
					print '<td>' . $db_field['windspeed'] . "</td>";
				print '</tr>';
				}

				?>

					</table>
				<?php

				mysql_close($opendb);
			}
			else
			{
				//Display table
				$SQL = "SELECT * FROM mydata order by date desc";
				$result = mysql_query($SQL);
				
				?>
				<table border="1">
					<tr>
						<td>Date</td>
						<td>Temp</td>
						<td>Pressure</td>
						<td>Humidity</td>
						<td>Rain</td>
						<td>DP Temp</td>
						<td>Altitude</td>
						<td>Wind Dir</td>
						<td>Wind Speed</td>
					</tr>
					<?php
						while ( $db_field = mysql_fetch_assoc($result) ) 
						{
							print '<tr>';
							print '<td>' . $db_field['date'] . "</td>";
							print '<td>' . $db_field['temp'] . "</td>";
							print '<td>' . $db_field['pressure'] . "</td>";
							print '<td>' . $db_field['humidity'] . "</td>";
							print '<td>' . $db_field['rain'] . "</td>";
							print '<td>' . $db_field['dptemp'] . "</td>";
							print '<td>' . $db_field['balt'] . "</td>";
							print '<td>' . $db_field['winddir'] . "</td>";
							print '<td>' . $db_field['windspeed'] . "</td>";
							print '</tr>';
						}

					?>
				</table>
				<?php
			}
		}
      ?>
</html>