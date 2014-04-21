<?php include('header.php'); ?>

<?php

    $today = date("Y-m-d", time() + 60 * 60 * 24);
	$sevenDaysAgo = date("Y-m-d", time() - 60 * 60 * 24 * 7);

    //Weekly Temp data
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as tempdate, temp FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)";
	
	$weeklyTempData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($weeklyTempData)) {
		
		$temp_name = $item['temp'];
	    $temp_time = date(strtotime($item['tempdate'])) * 1000;
	    $tempArr[] = ([($temp_time), $temp_name]);
	    $tempData = json_encode($tempArr, JSON_NUMERIC_CHECK);
	   
	}
	
	//Weekly Dew Point Data
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as dptempdate, dptemp FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)";
  	$weeklyDpTempData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($weeklyDpTempData)) {
		
		$name = $item['dptemp'];
	    $time = date(strtotime($item['dptempdate'])) * 1000;
	    $dpTempArr[] = ([($time), $name]);
	    $dewPointData = json_encode($dpTempArr, JSON_NUMERIC_CHECK);
	   
	}
	
	
	
	//weekly min temp data
	$SQL = "SELECT DATE(date) as myDate, HOUR(date) as hour, min(temp) as minTemp FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)";
  	$weeklyMinTempData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($weeklyMinTempData)) {

	   $data_weeklyMinValues[] = $row['minTemp'];
	}
	
	//Weekly Pressure Data
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as pressuredate, pressure FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)";
  	$weeklyPressureData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($weeklyPressureData)) {
	   
	   $name = $item['pressure'];
	   $time = date(strtotime($item['pressuredate'])) * 1000;
	   $pressureArr[] = ([($time), $name]);
	   $pressureData = json_encode($pressureArr, JSON_NUMERIC_CHECK);
	
	}
	
	//weekly min pressure data
	$SQL = "SELECT DATE(date) as myDate, HOUR(date) as hour, min(pressure) as minPressure FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)";
  	$weeklyMinPressureData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($weeklyMinPressureData)) {

	   $data_weeklyMinPressureValues[] = $row['minPressure'];
	}
	
	//Weekly Humidity Data
	
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as humiditydate, humidity FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)" ;
	$weeklyHumidityData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($weeklyHumidityData)) {
	   
	   $name = $item['humidity'];
	   $time = date(strtotime($item['humiditydate'])) * 1000;
	   $humidityArr[] = ([($time), $name]);
	   $humidityData = json_encode($humidityArr, JSON_NUMERIC_CHECK);
	   //echo(json_encode($humidityData, JSON_NUMERIC_CHECK)); 
	  
	}
	
	//Wekly Wind Speed Data
	
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as windspeeddate, windspeed FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)" ;
	$weeklyWindSpeedData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($weeklyWindSpeedData)) {
	   
	   $name = $item['windspeed'];
	   $time = date(strtotime($item['windspeeddate'])) * 1000;
	   $windSpeedArr[] = ([($time), $name]);
	   $windSpeedData = json_encode($windSpeedArr, JSON_NUMERIC_CHECK);
	   //echo(json_encode($humidityData, JSON_NUMERIC_CHECK)); 
	  
	}
	
	//Weekly Rain data
	//$SQL = "SELECT DATE(date) as myDate, HOUR(date) as hour, sum(rain) as rainfall FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DATE(date), HOUR(date)";
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s')as rainDate, sum(rain) as dailyRain FROM `mydata` WHERE  `date` >= '$sevenDaysAgo' AND `date` <= '$today' group by DAY(date)";  
	$dailyRainData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($dailyRainData)) {
	   
	   $name = $item['dailyRain'];
	   $time = date(strtotime($item['rainDate'])) * 1000;
	   $rainArr[] = ([($time), $name]);
	   $rainData = json_encode($rainArr, JSON_NUMERIC_CHECK);
	   //echo(json_encode($rainData, JSON_NUMERIC_CHECK));
	  
	}
	
	
?>

	<script type="text/javascript"> 
	
        
		$(function () {
		
			Highcharts.setOptions({
					global: {
						useUTC: false
						//timezoneOffset: 2
							}
			});
    		
			var weeklyTempSeries = <?php echo($tempData) ?>;
			var weeklyDewPointSeries = <?php echo($dewPointData) ?>
			
			$('#weeklyTempChart').highcharts({
                
				chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'spline',
				  zoomType: 'x'
			   },
			   title: {
			      text: 'Weekly Temperature/Dewpoint'
			   },
			   subtitle: {
			      text: 'Click and drag in plot area to zoom in'
			   },
			   xAxis: {
			      type: 'datetime',
				minPadding: 0.02,
				maxPadding: 0.02,
			   },
			   yAxis: {
			      title: {
			         text: 'Temperature (°C)'
			      },
				  labels: { 
					 formatter: function() { return Highcharts.numberFormat(this.value,0) +'°' } 
				  }
			   },
			   tooltip: {
                  crosshairs: true,
			      formatter: function() {
                            var s = '<b>'+ Highcharts.dateFormat('%d %b %I:%M %p', this.x) +'</b><br />';
                            $.each(this.points, function(i, point) {
                                s += '<br/>' + point.series.name + ': ' + point.y +'°C';
                            });
			                return s;
			      },
                  shared: true
			   },
				   colors: [ '#AA4643', '#4572A7', '#89A54E', '#80699B', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92' ],

			   plotOptions: {
			      spline: {
			         lineWidth: 4,
			         marker: {
			            enabled: false,
			         states: {
			            hover: {
			                  enabled: true,
			                  symbol: 'circle',
			                  radius: 3,
			                  lineWidth: 2
			            }
			         }
			         },
			         pointInterval: 300000, // one hour
			         
			         
			      }
			   },
			   series: [{
			      name: 'Temp',
			      data:	weeklyTempSeries	
			   },{
				  name: 'Dew Point',
				  data:	weeklyDewPointSeries
				}]
				
            });

			var pressureSeries = <?php echo($pressureData) ?>
						
			$('#weeklyPressureChart').highcharts({
                
				chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'line',
				  zoomType: 'x'
			   },
			   
				title: {
                    text: 'Weekly Barometer',
                    x: -20 //center
                },
                subtitle: {
			      text: 'Click and drag in plot area to zoom in'
			    },
				xAxis: {
                   	type: 'datetime',
					minPadding: 0.02,
					maxPadding: 0.02,
                },
                yAxis: {
                    title: {
                        text: 'Pressure (hPa)'
                    },
                    minorGridLineWidth: 0, 
					gridLineWidth: 1,
					alternateGridColor: null,
					labels: { formatter: function() {
								return Highcharts.numberFormat(this.value,0) +' hPa';
				  }
				  },
                },
               			   
			   tooltip: {
                  crosshairs: true,
			      formatter: function() {
                            var s = '<b>'+ Highcharts.dateFormat('%I:%M %p', this.x) +'</b><br />';
                            $.each(this.points, function(i, point) {
                                s += '<br/>' + point.series.name + ': ' + point.y +'hPa';
                            });
			                return s;
			      },
                  shared: true
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
                    name: 'Barometer',
					color: '#006400',
					data: pressureSeries
                }]
				
				
            });
			
			var humiditySeries = <?php echo($humidityData) ?>
			
						
			$('#weeklyHumidityChart').highcharts({
                
				chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'line',
				  zoomType: 'x'
			   },
			   
				title: {
                    text: 'Weekly Humidity',
                    x: -20 //center
                },
                subtitle: {
			      text: 'Click and drag in plot area to zoom in'
			    },
				xAxis: {
                   	type: 'datetime',
					minPadding: 0.02,
					maxPadding: 0.02,
                },
                yAxis: {
                    title: {
                        text: 'Humidity (%)'
                    },
                    max: 100,
					min: 0,
					minorGridLineWidth: 0, 
					gridLineWidth: 1,
					alternateGridColor: null,
					labels: { 
					formatter: function() {
								return Highcharts.numberFormat(this.value,0) +' %';
				  }
				  },
                },
                tooltip: {
                  crosshairs: true,
			      formatter: function() {
                            var s = '<b>'+ Highcharts.dateFormat('%I:%M %p', this.x) +'</b><br />';
                            $.each(this.points, function(i, point) {
                                s += '<br/>' + point.series.name + ': ' + point.y +'%';
                            });
			                return s;
			      },
                  shared: true
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
                    name: 'Humidity',
					color: '#CC3232',
					data: humiditySeries
                }]
				
				
            });
			
			var windSpeedSeries = <?php echo($windSpeedData) ?>
			
			$('#weeklyWindSpeedChart').highcharts({
                
				chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'line',
				  zoomType: 'x'
			   },
			   
				title: {
                    text: 'Weekly Wind Speed',
                    x: -20 //center
                },
                subtitle: {
			      text: 'Click and drag in plot area to zoom in'
			    },
				xAxis: {
                   	type: 'datetime',
					minPadding: 0.02,
					maxPadding: 0.02,
                },
                yAxis: {
                    title: {
                        text: 'Wind Speed (km/h)'
                    },
                    min: 0,
					minorGridLineWidth: 0, 
					gridLineWidth: 1,
					alternateGridColor: null,
					labels: { 
					formatter: function() {
								return Highcharts.numberFormat(this.value,0) +' km/h';
				  }
				  },
                },
                tooltip: {
                  crosshairs: true,
			      formatter: function() {
                            var s = '<b>'+ Highcharts.dateFormat('%I:%M %p', this.x) +'</b><br />';
                            $.each(this.points, function(i, point) {
                                s += '<br/>' + point.series.name + ': ' + point.y +'km/h';
                            });
			                return s;
			      },
                  shared: true
			   },
				
				plotOptions: {
			      areaspline: {
			         lineWidth: 1,
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
                    name: 'Wind Speed',
					type: 'areaspline',
					color: '#3A81B0',
					data: windSpeedSeries
                }]
				
				
            });
			
			var rainSeries = <?php echo($rainData) ?>;	
		
			$('#weeklyRainfallChart').highcharts({
				chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'column',
			      margin: [ 50, 50, 100, 80]
			   },
			   title: {
			      text: 'Weekly Rainfall'
			   },
			   //subtitle: {
			     // text: 'Westford Weather (Westford, VT)'
			   //},
			    xAxis: {
				labels: {
					align: 'center',
					style: {
						font: 'normal 9.2px Verdana, sans-serif'
					},
						formatter: function() {
							return Highcharts.dateFormat('%d. %b',this.value);
						}
				},
					type: 'datetime',
					tickInterval: 24 *300000,//24 * 3600 * 1000,
					minPadding: 0.02,
					maxPadding: 0.02,
				},

			   yAxis: {
			      min: 0,
				  labels: { formatter: function() {
					return Highcharts.numberFormat(this.value,1) +' mm';
					}
				  },
			      title: {
			         text: 'Rainfall (mm)'
			      }
			   },
			   legend: {
			      enabled: false
			   },
			   tooltip: {
			      crosshairs: true,
			      formatter: function() {
			         return '<b>'+ Highcharts.dateFormat('%d. %b',this.x) +'</b><br/>'+
			             'Rainfall: '+ Highcharts.numberFormat(this.y, 2) +
			             ' mm';
			      }
			   },
			   plotOptions: {
					column: {
						pointWidth:16
					}
				},
			         series: [{
			         name: 'Rainfall',
			         data: rainSeries,
			         dataLabels: {
			         enabled: true,
			         rotation: -90,
			         color: '#FFFFFF',
			         align: 'center',
			         x: 7,
			         y: 14,
			         formatter: function() {
			            return Highcharts.numberFormat(this.y, 2);
			         },
			         style: {
			            font: 'normal 11px Verdana, sans-serif'
			         }
			      }         
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
		<div id="weeklyWindSpeedChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <div id="weeklyRainfallChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</div><!-- /.container -->
<?php include('footer.php'); ?>