<?php include('header.php'); ?>

<?php

    $today = date("Y-m-d", time() + 60 * 60 * 24);
	$yesterday = date("Y-m-d", time());

    //latest temp data
	$SQL = "select date, temp from mydata order by id desc limit 1";
  	$currentTemp = mysql_query($SQL);
  	while ($row = mysql_fetch_array($currentTemp)) {

	   $data_temp[] = $row['temp'];
	   
	}

	//latest pressure data
	$SQL = "select date, pressure from mydata order by id desc limit 1";
  	$currentPressure = mysql_query($SQL);
  	while ($row = mysql_fetch_array($currentPressure)) {

	   $data_pressure[] = $row['pressure'];
	   
	}
	
	//latest humidity data
	$SQL = "select date, humidity from mydata order by id desc limit 1";
  	$currentHumidity = mysql_query($SQL);
  	while ($row = mysql_fetch_array($currentHumidity)) {

	   $data_humidity[] = $row['humidity'];
	   
	}
	
	//today's rainfall
	$SQL = "select date as day, sum(rain) as dailyrain from mydata WHERE  `date` >= '$yesterday' AND `date` <= '$today' group by day(date)";
  	$dailyRainfall = mysql_query($SQL);
  	while ($row = mysql_fetch_array($dailyRainfall)) {

	   $data_RainCats[] = $row['day'];
	   $data_dailyRainfall[] = $row['dailyrain'];
	   
	}
	
	
?>

	<script type="text/javascript">
        $(function () {
				
			var temp = [ <?php echo join($data_temp, ',') ?> ]
									
			$('#tempGuage').highcharts({
	
			chart: {
	        type: 'gauge',
	        alignTicks: false,
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: false
	    },
	
	    title: {
	        text: 'Current Temperature'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150
	    },	        
	
	    yAxis: [{
	        
	        min: -10,
	        max: 50,
	        tickPosition: 'outside',
	        lineColor: '#933',
	        lineWidth: 2,
	        minorTickPosition: 'outside',
	        tickColor: '#933',
	        minorTickColor: '#933',
	        tickLength: 5,
	        minorTickLength: 5,
	        labels: {
	            distance: 12,
	            rotation: 'auto'
	        },
	        offset: -20,
	        endOnTick: false
	    }],
	
	    series: [{
	        name: 'Temp',
	        data: temp,
	        dataLabels: {
	            formatter: function () {
	                var tempLabel = temp;
	                return '<span style="color:#339">'+ tempLabel + ' °C</span>'; 
	            },
	            backgroundColor: {
	                linearGradient: {
	                    x1: 0,
	                    y1: 0,
	                    x2: 0,
	                    y2: 1
	                },
	                stops: [
	                    [0, '#DDD'],
	                    [1, '#FFF']
	                ]
	            }
	        },
	        tooltip: {
	            valueSuffix: ' °C'
	        }
	    }]
	
	},
	// Add some life
	function(chart) {
	    	
	});
	
			var pressure = [ <?php echo join($data_pressure, ',') ?> ]	
							
			$('#pressureGuage').highcharts({
	
			chart: {
	        type: 'gauge',
	        alignTicks: false,
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: false
	    },
	
	    title: {
	        text: 'Current Pressure'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150
	    },	        
	
	    yAxis: [{
	        
	        min: 840,
	        max: 860,
	        tickPosition: 'outside',
	        lineColor: '#933',
	        lineWidth: 2,
	        minorTickPosition: 'outside',
	        tickColor: '#933',
	        minorTickColor: '#933',
	        tickLength: 5,
	        minorTickLength: 5,
	        labels: {
	            distance: 12,
	            rotation: 'auto'
	        },
	        offset: -20,
	        endOnTick: false
	    }],
	
	    series: [{
	        name: 'Pressure',
	        data: pressure,
	        dataLabels: {
	            formatter: function () {
	                var pressLabel = pressure;
	                return '<span style="color:#339">'+ pressLabel + ' hPa</span>'; 
	            },
	            backgroundColor: {
	                linearGradient: {
	                    x1: 0,
	                    y1: 0,
	                    x2: 0,
	                    y2: 1
	                },
	                stops: [
	                    [0, '#DDD'],
	                    [1, '#FFF']
	                ]
	            }
	        },
	        tooltip: {
	            valueSuffix: ' hPa'
	        }
	    }]
	
	},
	// Add some life
	function(chart) {
	    	
	});
	
			var humidity = [ <?php echo join($data_humidity, ',') ?> ]	
							
			$('#humidityGuage').highcharts({
	
			chart: {
	        type: 'gauge',
	        alignTicks: false,
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: false
	    },
	
	    title: {
	        text: 'Current Humidity'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150
	    },	        
	
	    yAxis: [{
	        
	        min: 0,
	        max: 105,
	        tickPosition: 'outside',
	        lineColor: '#933',
	        lineWidth: 2,
	        minorTickPosition: 'outside',
	        tickColor: '#933',
	        minorTickColor: '#933',
	        tickLength: 5,
	        minorTickLength: 5,
	        labels: {
	            distance: 12,
	            rotation: 'auto'
	        },
	        offset: -20,
	        endOnTick: false
	    }],
	
	    series: [{
	        name: 'Humidity',
	        data: humidity,
	        dataLabels: {
	            formatter: function () {
	                var humLabel = humidity;
	                return '<span style="color:#339">'+ humLabel + ' %</span>'; 
	            },
	            backgroundColor: {
	                linearGradient: {
	                    x1: 0,
	                    y1: 0,
	                    x2: 0,
	                    y2: 1
	                },
	                stops: [
	                    [0, '#DDD'],
	                    [1, '#FFF']
	                ]
	            }
	        },
	        tooltip: {
	            valueSuffix: ' %'
	        }
	    }]
	
	},
	// Add some life
	function(chart) {
	    	
	});
	
			//var rainCat = [ <?php echo join($data_RainCats, ',') ?> ]
			var rainData = [ <?php echo join($data_dailyRainfall, ',') ?> ]
		
		
			$('#rainfall').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Daily Rainfall'
				},
				
				xAxis: {
					categories: ["Today"]
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
	
	
	
});


		</script>

  <?php include('nav.php'); ?>

    <div class="container">
		
    	<div id="tempGuage" style="min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto; float: left"></div>
		<div id="pressureGuage" style="min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto; float: left"></div>
        <div id="humidityGuage" style="min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto; float: left"></div>
		<div id="rainfall" style="min-width: 310px; max-width: 400px; height: 400px; margin: 0 auto; float: left"></div>
		
	</div><!-- /.container -->
<?php include('footer.php'); ?>