<?php include('header.php'); ?>

<?php

    $today = date("Y-m-d", time() - 60 * 60 * 24);

    //temp data
	$SQL = "SELECT HOUR(date) as hour, max(temp) as temp FROM `mydata` WHERE  `date` >= '$today' group by HOUR(date)";
  	$maxHourlyTempData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($maxHourlyTempData)) {

	   $data_cats[] = $row['hour'];
	   $data_values[] = $row['temp'];
	}

    //pressure data
	$SQL = "SELECT HOUR(date) as hour, max(pressure) as pressure FROM `mydata` WHERE  `date` >= '$today' group by HOUR(date)";
  	$maxHourlyPressureData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($maxHourlyPressureData)) {

	   $data_pressureCats[] = $row['hour'];
	   $data_pressureValues[] = $row['pressure'];
	}
?>

	<script type="text/javascript">
        $(function () {

    		var cats = [ <?php echo join($data_cats, ',') ?> ]
    		var data = [ <?php echo join($data_values, ',') ?> ]

            $('#tempChart').highcharts({
                title: {
                    text: 'Daily Max Temperature',
                    x: -20 //center
                },
                xAxis: {
                    categories: cats
                },
                yAxis: {
                    title: {
                        text: 'Temperature (°C)'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#FF0000'
                    }]
                },
                tooltip: {
                    valueSuffix: '°C'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: 'Hourly Max',
                    data: data
                }]
            });

            var pressureCats = [ <?php echo join($data_pressureCats, ',') ?> ]
            var pressureData = [ <?php echo join($data_pressureValues, ',') ?> ]

            $('#pressureChart').highcharts({
                title: {
                    text: 'Daily Max Pressure',
                    x: -20 //center
                },
                xAxis: {
                    categories: pressureCats
                },
                yAxis: {
                    title: {
                        text: 'Pressure (hPa)'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: 'hPa'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: 'Hourly Max',
                    data: pressureData
                }]
            });
        });


		</script>

  <?php include('nav.php'); ?>

    <div class="container">

    	<div id="tempChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <div id="pressureChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</div><!-- /.container -->
<?php include('footer.php'); ?>