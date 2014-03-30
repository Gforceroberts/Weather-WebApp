<?php include('header.php'); ?>
  <?php include('nav.php'); ?>

    <div class="container">

      <div class="starter-template">
        <h1>Force-cast Weather</h1>
        <p class="lead">Check here for all your weather updates in and around Force's house!!</p>
      </div>

      <?php

        //$variables = new Variables();
        //print("here: " . $variables->GetVariable("ALTITUDE"));
        //exit;

        //Display table
          $SQL = "SELECT date, temp, pressure, humidity, rain, dptemp, balt, winddir, windspeed FROM mydata order by date desc limit 1000";
          $result = mysql_query($SQL);

          ?>
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>Date</th>
                <th>Temp <br />(*C)</th>
                <th>Pressure <br />(hPa)</th>
                <th>Humidity <br />(%)</th>
                <th>Rain <br />(mm)</th>
				<th>Dew Point <br />temp</th>
				<th>Altitude <br />baro</th>
				<th>Wind Dir</th>
				<th>Wind Speed</th>
              </tr>
            </thead>
            <tbody>

              <?php

                while ( $db_field = mysql_fetch_assoc($result) ) {
                print '<tr>';

                  $date = $db_field['date'];
                  $rain = $db_field['rain'];

                  print '<td>' . $date . "</td>";
                  print '<td>' . $db_field['temp'] . "</td>";
                  print '<td>' . $db_field['pressure'] . "</td>";
                  print '<td>' . $db_field['humidity'] . "</td>";

                  if($rain > 10)
                  {
                    print '<td class="info">' . $rain . "</td>";
                  }
                  else
                  {
                    print '<td>' . $rain . "</td>";
                  }
				  
				  print '<td>' . $db_field['dptemp'] . "</td>";
				  print '<td>' . $db_field['balt'] . "</td>";
				  print '<td>' . $db_field['winddir'] . "</td>";
				  print '<td>' . $db_field['windspeed'] . "</td>";

                print '</tr>';
                }

              ?>
              </tbody>
            </table>
          <?php

          mysql_close($opendb);

      ?>


    </div><!-- /.container -->
<?php include('footer.php'); ?>
