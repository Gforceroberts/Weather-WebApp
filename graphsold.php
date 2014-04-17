<?php include('header.php'); ?>

<?php

    
	
	$today = date("Y-m-d", time());// + 60 * 60 * 24);

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
	//$SQL = "SELECT HOUR(date) as hour, max(pressure) as pressure FROM `mydata` WHERE  `date` >= '2014-04-01' group by HOUR(date)";
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as mydate, pressure FROM `mydata` WHERE  date >= '2014-03-31' AND date <= '2014-04-01'";
	//$SQL = "SELECT date as mydate, pressure FROM 'mydata' WHERE  'date' = '2014-03-29'";
  	$result = mysql_query($SQL);
  	while ($item = mysql_fetch_array($result)) {
	   
	   $name = $item['pressure'];
	   $time = date(strtotime($item['mydate'])) * 1000;
	   $arr[] = ([($time), $name]);
	   $json = json_encode($arr, JSON_NUMERIC_CHECK);
	   
	   	   
	  $data_pressureCats[] = $row['hour'];
	  $data_maxPressureValues[] = $row['pressure'];
	}
		
		
	//min pressure data
	$SQL = "SELECT HOUR(date) as hour, min(pressure) as minPressure FROM `mydata` WHERE  `date` >= '2014-04-01' group by HOUR(date)";
  	$minHourlyPressureData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($minHourlyPressureData)) {
	
	   //$data_pressureCats[] = $row['hour'];
	   $data_minPressureValues[] = $row['minPressure'];
	}
	
	
	//humidity data
	$SQL = "SELECT HOUR(date) as hour, max(humidity) as maxHumidity FROM `mydata` WHERE  `date` >= '$today' group by HOUR(date)";
  	//$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as mydate, humidity FROM `mydata` WHERE  date >= '2014-04-10'" ;
		
	$humidityData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($humidityData)) {
	
	   //$hum_name = $item['humidity'];
	   //$hum_time = date(strtotime($item['mydate'])) * 1000;
	   //$hum_arr[] = ([($hum_time), $hum_name]);
	   //$hum_json = json_encode($hum_arr, JSON_NUMERIC_CHECK);
	   
	   $data_humidityCats[] = $row['hour'];
	   $data_humidityValues[] = $row['MaxHumidity'];
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
			var mydata = <?php echo($json) ?>

            
			$('#pressureChart').highcharts({
                 chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'line',
				  zoomType: 'x'
			   },
			   
				title: {
                    //type: 'spline',
					text: 'Daily Pressure',
                    x: -20 //center
                },
                xAxis: {
                    //categories: pressureCats
					type: 'datetime',
					minPadding: 0.02,
					maxPadding: 0.02,
                },
                yAxis: {
                    title: {
                        text: 'Pressure (hPa)'
                    },
                    //max: 31.50,min: 28.50,
					minorGridLineWidth: 0, 
					gridLineWidth: 1,
					alternateGridColor: null,
					labels: { formatter: function() {
								return Highcharts.numberFormat(this.value,2) +'';
				  }
				  },
                },
                tooltip: {
                    //valueSuffix: 'hPa'
					crosshairs: true,
					formatter: function() {
									return '<b>'+ Highcharts.dateFormat('%I:%M %p', this.x) +'</b><br/> '+ Highcharts.numberFormat(this.y,2) +' in. Hg';
			      }
                },
				
				plotOptions: {
			      line: {
			         lineWidth: 4,
			         marker: {
			            enabled: false,
			         states: {
			            hover: {
			                  enabled: true,
			                  symbol: 'circle',
			                  radius: 3,
			                  lineWidth: 1
			            }
			         }
			         },
			         pointInterval: 300000, // one hour
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
					color: '#006400',
					data: mydata
                }]
            });
			
			var humidityCats = [ <?php echo join($data_humidityCats, ',') ?> ]
            var humidityData = [ <?php echo join($data_humidityValues, ',') ?> ]
		
			$('#humidityChart').highcharts({
                chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'line',
				  zoomType: 'x'
			   },
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