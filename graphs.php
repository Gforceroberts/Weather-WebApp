<?php include('header.php'); ?>

<?php

    $today = date("Y-m-d", time());// + 60 * 60 * 24);
	$PHPDate = date("d, j M Y H:i:s T", strtotime($today) );
	$timeSep = "9";
	
	
    //max temp data
	$SQL = "SELECT HOUR(date) as hour, max(temp) as maxTemp FROM `mydata` WHERE  `date` >= '2014-04-01' group by HOUR(date)";
  	$maxHourlyTempData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($maxHourlyTempData)) {

	   $data_cats[] = $row['hour'];
	   $data_maxValues[] = $row['maxTemp'];
	}

	//min temp data
	$SQL = "SELECT HOUR(date) as hour, min(temp) as minTemp FROM `mydata` WHERE  `date` >= '2014-04-01' group by HOUR(date)";
  	$minHourlyTempData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($minHourlyTempData)) {

	   $data_minValues[] = $row['minTemp'];
	}
	
    //max pressure data
	$SQL = "SELECT HOUR(date) as hour, max(pressure) as pressure FROM `mydata` WHERE  `date` >= '2014-04-01' group by HOUR(date)";
  	$maxHourlyPressureData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($maxHourlyPressureData)) {

	   $data_pressureCats[] = $row['hour'];
	   $data_maxPressureValues[] = $row['pressure'];
	}
	
	//max pressure data
	$SQL = "SELECT HOUR(date) as hour, min(pressure) as minPressure FROM `mydata` WHERE  `date` >= '2014-04-01' group by HOUR(date)";
  	$minHourlyPressureData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($minHourlyPressureData)) {

	   $data_pressureCats[] = $row['hour'];
	   $data_minPressureValues[] = $row['minPressure'];
	}
	
	
	//humidity data
	//$SQL = "SELECT HOUR(date) as hour, max(humidity) as maxHumidity FROM `mydata` WHERE  `date` >= '2014-04-01' group by HOUR(date)";
  	$SQL = "SELECT DATE_FORMAT(date, '%H%i') as time, humidity as humidity FROM `mydata` WHERE  `date` >= '2014-04-01'";
	//$SQL = "SELECT TIME(date) as time, humidity as humidity FROM `mydata` WHERE  `date` >= '2014-04-01'";
	$maxHourlyHumidityData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($maxHourlyHumidityData)) {

	   $data_humidityCats[] = $row['time'];
	   $data_humidityValues[] = $row['humidity'];
	}
		
	//rain data
	$SQL = "SELECT HOUR(date) as hour, sum(rain) as hourlyRain FROM `mydata` WHERE  `date` >= '2014-04-01' group by HOUR(date)";
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
                    type: 'line',
					text: 'Daily Temperature',
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
                    valueSuffix: '°C',
					crosshairs: true,
					shared: true
                },
				
				plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
							}
						}
				},
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: 'Hourly Max',
					color: '#FF0000',
                    data: maxData
                }, {
					name: 'Hourly Min',
					color: '#8FD8D8',
                    data: minData
				
				}]
            });

            var pressureCats = [ <?php echo join($data_pressureCats, ',') ?> ]
            var maxPressureData = [ <?php echo join($data_maxPressureValues, ',') ?> ]
			var minPressureData = [ <?php echo join($data_minPressureValues, ',') ?> ]

            $('#pressureChart').highcharts({
                title: {
                    type: 'spline',
					text: 'Daily Pressure',
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
					color: '#006400',
                    data: maxPressureData
				//}, {
					//name: 'Hourly Min',
					//color: '#CCFF66',
                    //data: minPressureData
                }]
            });
			
			var humidityCats = [ <?php echo join($data_humidityCats, ',') ?> ]
            var humidityData = [ <?php echo join($data_humidityValues, ',') ?> ]
		
			$('#humidityChart').highcharts({
                title: {
                    text: 'Daily Humidity',
                    x: -20 //center
                },
                xAxis: {
                    categories: humidityCats
                },
                yAxis: {
                    title: {
                        text: 'Humidity (%)'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: '%'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: 'Hourly Max',
					color: '#CC3232',
                    data: humidityData
                }]
            });
					
			var rainCats = [ <?php echo join($data_hourlyRainCats, ',') ?> ]
            var rainData = [ <?php echo join($data_hourlyRainValues, ',') ?> ]
		
		
			$('#rainfallChart').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Daily Rainfall'
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
					name: 'Hourly Rainfall',
					data: rainData
		
			
				}]
			});
			
			function secondsToHms(d) {
			d = Number(d);
			var h = Math.floor(d / 3600);
			var m = Math.floor(d % 3600 / 60);
			var s = Math.floor(d % 3600 % 60);
			if (h<9){h= "0"+h;}
			if (m<9){m= "0"+m;}
			if (s<9){s= "0"+s;}
			return (h+":"+m+":"+ s);
				}
				
		});


		</script>

  <?php include('nav.php'); ?>

    <div class="container">

    	<div id="tempChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <div id="pressureChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<div id="humidityChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<div id="rainfallChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</div><!-- /.container -->
<?php include('footer.php'); ?>