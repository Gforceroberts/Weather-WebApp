<?php include('header.php'); ?>

<?php

    $today = date("Y-m-d", time() + 60 * 60 * 24);
	$sevenDaysAgo = date("Y-m-d", time() - 60 * 60 * 24 * 7);

    //weekly max temp data
	$SQL = "SELECT DATE(date) as myDate, HOUR(date) as hour, max(temp) as maxTemp FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)";
  	$weeklyMaxTempData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($weeklyMaxTempData)) {

	   $data_weeklyTempCats[] = $row['hour'];
	   $data_weeklyMaxValues[] = $row['maxTemp'];
	}

	//weekly min temp data
	$SQL = "SELECT DATE(date) as myDate, HOUR(date) as hour, min(temp) as minTemp FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)";
  	$weeklyMinTempData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($weeklyMinTempData)) {

	   $data_weeklyMinValues[] = $row['minTemp'];
	}
	
	//weekly max pressure data
	$SQL = "SELECT DATE(date) as myDate, HOUR(date) as hour, max(pressure) as maxPressure FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)";
  	$weeklyMaxPressureData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($weeklyMaxPressureData)) {

	   $data_weeklyPressureCats[] = $row['hour'];
	   $data_weeklyMaxPressureValues[] = $row['maxPressure'];
	}
	
	//weekly min pressure data
	$SQL = "SELECT DATE(date) as myDate, HOUR(date) as hour, min(pressure) as minPressure FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)";
  	$weeklyMinPressureData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($weeklyMinPressureData)) {

	   $data_weeklyMinPressureValues[] = $row['minPressure'];
	}
	
	//weekly max humidity data
	$SQL = "SELECT DATE(date) as myDate, HOUR(date) as hour, max(humidity) as maxHumidity FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)";
  	$weeklyMaxHumidityData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($weeklyMaxHumidityData)) {

	   $data_weeklyHumidityCats[] = $row['hour'];
	   $data_weeklyMaxHumidityValues[] = $row['maxHumidity'];
	}
	
	//rain data
	$SQL = "SELECT DATE(date) as myDate, HOUR(date) as hour, sum(rain) as rainfall FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)";
  	$weeklyRainData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($weeklyRainData)) {

	   $data_weeklyRainCats[] = $row['hour'];
	   $data_weeklyRainValues[] = $row['rainfall'];
	}
	
	
?>

	<script type="text/javascript"> 
	
        
		$(function () {

    		var weeklyCats = [ <?php echo join($data_weeklyTempCats, ',') ?> ]
    		var weeklyMaxTempData = [ <?php echo join($data_weeklyMaxValues, ',') ?> ]
			var weeklyMinTempData = [ <?php echo join($data_weeklyMinValues, ',') ?> ]
			
			
			$('#weeklyTempChart').highcharts({
                
				title: {
                    text: 'Weekly Temperature',
                    x: -20 //center
                },
                xAxis: {
                    categories: weeklyCats,
					max: 20
					//max: 10
				},
					
				
				legend: {
					verticalAlign: 'top',
					y: 100,
					align: 'right'
				},
    
				scrollbar: {
					enabled: true
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
					color: '#FF0000',
                    data: weeklyMaxTempData
                }, {	
				    name: 'Hourly Min',
					color: '#8FD8D8',
                    data: weeklyMinTempData
				
				}]
				
				
            });

			var weeklyPressureCats = [ <?php echo join($data_weeklyPressureCats, ',') ?> ]
    		var weeklyMaxPressureData = [ <?php echo join($data_weeklyMaxPressureValues, ',') ?> ]
			var weeklyMinPressureData = [ <?php echo join($data_weeklyMinPressureValues, ',') ?> ]
						
			$('#weeklyPressureChart').highcharts({
                
				title: {
                    text: 'Weekly Pressure',
                    x: -20 //center
                },
                xAxis: {
                    categories: weeklyPressureCats,
					max: 20
					
                },
				legend: {
					verticalAlign: 'top',
					y: 100,
					align: 'right'
				},
    
				scrollbar: {
				enabled: true
				},
				
				
                yAxis: {
                    title: {
                        text: 'Pressure (hPa)'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#FF0000'
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
                    data: weeklyMaxPressureData
				//}, {	
				    //name: 'Hourly Min',
					//color: '#00CCCC',
                    //data: weeklyMinPressureData	
				
				}]
				
				
            });
			
			var weeklyHumidityCats = [ <?php echo join($data_weeklyHumidityCats, ',') ?> ]
    		var weeklyMaxHumidityData = [ <?php echo join($data_weeklyMaxHumidityValues, ',') ?> ]
			
						
			$('#weeklyHumidityChart').highcharts({
                
				title: {
                    text: 'Weekly Humidity',
                    x: -20 //center
                },
                xAxis: {
                    categories: weeklyHumidityCats,
					max: 20
					
                },
				legend: {
					verticalAlign: 'top',
					y: 100,
					align: 'right'
				},
    
				scrollbar: {
				enabled: true
				},
				
				
                yAxis: {
                    title: {
                        text: 'Humidity (%)'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#FF0000'
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
                    data: weeklyMaxHumidityData
				//}, {	
				    //name: 'Hourly Min',
					//color: '#CCFF66',
                   // data: weeklyMinHumidityData	
				
				}]
				
				
            });
			
			var weeklyRainCats = [ <?php echo join($data_weeklyRainCats, ',') ?> ]
            var weeklyRainData = [ <?php echo join($data_weeklyRainValues, ',') ?> ]
		
		
			$('#weeklyRainfallChart').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Weekly Rainfall'
				},
				
				xAxis: {
					categories: weeklyRainCats,
					max: 60
				},
				
				scrollbar: {
				enabled: true
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
					data: weeklyRainData
		
			
				}]
			});
					
		});


		</script>

  <?php include('nav.php'); ?>

    <div class="container">

    	
		<!--<div id="weeklyTempChart" style="height: 300px"></div>-->
		<div id="weeklyTempChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<div id="weeklyPressureChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<div id="weeklyHumidityChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <div id="weeklyRainfallChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</div><!-- /.container -->
<?php include('footer.php'); ?>