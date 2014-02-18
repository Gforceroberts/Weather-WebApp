<?php include('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Force-ometer</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/site.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Force-ometer</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <!--<li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

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


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
