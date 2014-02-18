<html>
      <?php
			
            $DATA = $_GET['values'];
			$temp = $_GET['temp'];
			$pressure = $_GET['pressure'];
			$humidity = $_GET['humidity'];
			$rain = $_GET['rain'];
			
                  //Connect to database
                  $opendb = mysql_connect("localhost", "greenfig_force", "@force123") or mysql_error("Could not connect to database");
                 mysql_select_db("greenfig_force");
				 
				 if(empty($DATA)) $DATA = 0;
				 if(empty($temp)) $temp = 0;
				 if(empty($pressure)) $pressure = 0;
				 if(empty($humidity)) $humidity = 0;
				 if(empty($rain)) $rain = 0;
				 
    
     if ($opendb)
            {
				if(!empty($temp))
				{
					date_default_timezone_set('Africa/Johannesburg');
					$date = date('Y-m-d H:i:s');
					
					$sql = "INSERT INTO `greenfig_force`.`mydata` (`date`, `data`,`temp`,`pressure`,`humidity`,`rain`) VALUES ('$date', '$DATA', $temp, $pressure, $humidity, $rain);";
					print $sql;
					mysql_query($sql) or die(mysql_error());
					
				//}
				//else
				//{
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
					</tr>
					<?php
					
					while ( $db_field = mysql_fetch_assoc($result) ) {
					print '<tr>';
						print '<td>' . $db_field['date'] . "</td>";
						print '<td>' . $db_field['temp'] . "</td>";
						print '<td>' . $db_field['pressure'] . "</td>";
						print '<td>' . $db_field['humidity'] . "</td>";
						print '<td>' . $db_field['rain'] . "</td>";
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
					</tr>
					<?php
					
					while ( $db_field = mysql_fetch_assoc($result) ) {
					print '<tr>';
						print '<td>' . $db_field['date'] . "</td>";
						print '<td>' . $db_field['temp'] . "</td>";
						print '<td>' . $db_field['pressure'] . "</td>";
						print '<td>' . $db_field['humidity'] . "</td>";
						print '<td>' . $db_field['rain'] . "</td>";
					print '</tr>';
					}
					
					?>
						
						</table>
					<?php
				}
				
				
            }
      ?>
</html>