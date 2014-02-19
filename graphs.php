<?php include('header.php'); ?>

<?php

    $today = date("Y-m-d", time() - 60 * 60 * 24);

    //max temp data
	$SQL = "SELECT HOUR(date) as hour, max(temp) as maxTemp FROM `mydata` WHERE  `date` >= '$today' group by HOUR(date)";
  	$maxHourlyTempData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($maxHourlyTempData)) {

	   $data_cats[] = $row['hour'];
	   $data_maxValues[] = $row['maxTemp'];
	}

	//min temp data
	$SQL = "SELECT HOUR(date) as hour, min(temp) as minTemp FROM `mydata` WHERE  `date` >= '$today' group by HOUR(date)";
  	$minHourlyTempData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($minHourlyTempData)) {

	   $data_minValues[] = $row['minTemp'];
	}
	
    //pressure data
	$SQL = "SELECT HOUR(date) as hour, max(pressure) as pressure FROM `mydata` WHERE  `date` >= '$today' group by HOUR(date)";
  	$maxHourlyPressureData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($maxHourlyPressureData)) {

	   $data_pressureCats[] = $row['hour'];
	   $data_pressureValues[] = $row['pressure'];
	}
	
	//rain data
	$SQL = "SELECT HOUR(date) as hour, sum(rain) as hourlyRain FROM `mydata` WHERE  `date` >= '$today' group by HOUR(date)";
  	$hourlyRainData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($hourlyRainData)) {

	   $data_hourlyRainCats[] = $row['hour'];
	   $data_hourlyRainValues[] = $row['hourlyRain'];
	}
?>

	<script type="text/javascript">
        $(function () {

    		var cats = [ <?php echo join($data_cats, ',') ?> ]
    		var maxData = [ <?php echo join($data_maxValues, ',') ?> ]
			var minData = [ <?php echo join($data_minValues, ',') ?> ]

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
                    data: maxData
                }, {
					name: 'Hourly Min',
                    data: minData
				
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
        
		
			var rainCats = [ <?php echo join($data_hourlyRainCats, ',') ?> ]
            var rainData = [ <?php echo join($data_hourlyRainValues, ',') ?> ]
		
		
			$('#rainfallChart').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Hourly Rainfall'
				},
				
				xAxis: {
					categories: rainCats
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Rainfall (mm)'
					}
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
				series: [{
					name: 'Rainfall',
					data: rainData
		
			
				}]
			});
				
		});


		</script>

  <?php include('nav.php'); ?>

    <div class="container">

    	<div id="tempChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <div id="pressureChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<div id="rainfallChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</div><!-- /.container -->
<?php include('footer.php'); ?>