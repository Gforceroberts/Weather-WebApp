<?php include('header.php'); ?>
  <?php include('nav.php'); ?>

    <div class="container">

      <div class="starter-template">
        <h1>The weather data</h1>
        <p class="lead">Check here for all your weather updates in and around Force's house!!</p>
      </div>

      <?php

        //Display table
          $SQL = "SELECT DATE_FORMAT(date,'%b %d, %k:%i') as date, temp, pressure, humidity, rain FROM mydata order by date desc limit 100";
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
