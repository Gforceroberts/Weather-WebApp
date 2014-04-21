<?php include('header.php'); ?>

<?php

    
	
	$today = date("Y-m-d", time()); //add two hours for time zone
	
	//Daily Temp Data
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as tempdate, temp FROM `mydata` WHERE  date >= '$today'";
  	$dailyTempData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($dailyTempData)) {
		
		$temp_name = $item['temp'];
	    $temp_time = date(strtotime($item['tempdate'])) * 1000;
	    $tempArr[] = ([($temp_time), $temp_name]);
	    $tempData = json_encode($tempArr, JSON_NUMERIC_CHECK);
		//echo(json_encode($tempData, JSON_NUMERIC_CHECK));
	   
	}

	//Daily Dew Point Data
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as dptempdate, dptemp FROM `mydata` WHERE  date >= '$today'";
  	$dailyDpTempData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($dailyDpTempData)) {
		
		$name = $item['dptemp'];
	    $time = date(strtotime($item['dptempdate'])) * 1000;
	    $dpTempArr[] = ([($time), $name]);
	    $dewPointData = json_encode($dpTempArr, JSON_NUMERIC_CHECK);
	   
	}
	
	//Daily Pressure Data
	
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as pressuredate, pressure FROM `mydata` WHERE  date >= '$today'";
	$dailyPressureData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($dailyPressureData)) {
	   
	   $name = $item['pressure'];
	   $time = date(strtotime($item['pressuredate'])) * 1000;
	   $pressureArr[] = ([($time), $name]);
	   $pressureData = json_encode($pressureArr, JSON_NUMERIC_CHECK);
	
	}
	
	//Daily Humidity Data
	
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as humiditydate, humidity FROM `mydata` WHERE  date >= '$today'";
	$dailyHumidityData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($dailyHumidityData)) {
	   
	   $name = $item['humidity'];
	   $time = date(strtotime($item['humiditydate'])) * 1000;
	   $humidityArr[] = ([($time), $name]);
	   $humidityData = json_encode($humidityArr, JSON_NUMERIC_CHECK);
	     
	  
	}
	
	//rain data
	//$SQL = "SELECT HOUR(date) as hour, sum(rain) as hourlyRain FROM `mydata` WHERE  `date` >= '2014-04-01' group by HOUR(date)";
	  $SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s')as hour, sum(rain) as hourlyRain FROM `mydata` WHERE  `date` >= '$today' group by HOUR(date)";  
  	//$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as raindate, sum(rain) as hourlyRain FROM `mydata` WHERE  date >= '$today'";
	$dailyRainData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($dailyRainData)) {
	   
	   $name = $item['hourlyRain'];
	   $time = date(strtotime($item['hour'])) * 1000;
	   $rainArr[] = ([($time), $name]);
	   $rainData = json_encode($rainArr, JSON_NUMERIC_CHECK);
	   //echo(json_encode($rainData, JSON_NUMERIC_CHECK));
	  
	}
	
	//Daily Wind Speed Data
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as windspeeddate, windspeed FROM `mydata` WHERE  date >= '$today'";
  	$dailyWindSpeedData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($dailyWindSpeedData)) {
		
		$name = $item['windspeed'];
	    $time = date(strtotime($item['windspeeddate'])) * 1000;
	    $windSpeedArr[] = ([($time), $name]);
	    $windSpeedData = json_encode($windSpeedArr, JSON_NUMERIC_CHECK);
	   
	}

	//Daily Wind Direction Data
	$SQL = "SELECT DATE_FORMAT(date, '%Y-%m-%d,%H:%i:%s') as winddirdate, winddir FROM `mydata` WHERE  date >= '$today'";
  	$dailyDpTempData = mysql_query($SQL);
  	while ($item = mysql_fetch_array($dailyDpTempData)) {
		
		//$name = $item['winddir'];
	    //$time = date(strtotime($item['winddirdate'])) * 1000;
	    switch ($item['winddir']) {
			case ("N"):
				$winddir = 360;
			break;
			case ("NW"):
				$winddir = 315;
			break;
			case ("W"):
				$winddir = 270;
			break;
			case ("SW"):
				$winddir = 225;
			break;
			case ("S"):
				$winddir = 180;
			break;
			case ("SE"):
				$winddir = 135;
			break;
			case ("E"):
				$winddir = 90;
			break;
			case ("NE"):
				$winddir = 45;
			break;
			default:
			$winddir = 0;
			break;
		}		
		$time = date(strtotime($item['winddirdate'])) * 1000;	
		$windDirArr[] = ([($time), $winddir]);
	    $windDirData = json_encode($windDirArr, JSON_NUMERIC_CHECK);
	   
	}
	
	
	
	
?>

	<script type="text/javascript">
	   
	   
	   
	   $(function () {
	   
			Highcharts.setOptions({
				global: {
					//useUTC: false
					timezoneOffset: 2
						}
			});
				
			var tempSeries = <?php echo($tempData) ?>;
			var dewPointSeries = <?php echo($dewPointData) ?>
    		

            $('#tempChart').highcharts({
                chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'spline',
				  zoomType: 'x'
			   },
			   title: {
			      text: 'Today\'s Temperature/Dewpoint'
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
                            var s = '<b>'+ Highcharts.dateFormat('%I:%M %p', this.x) +'</b><br />';
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
			      data:	tempSeries	
			   },{
				  name: 'Dew Point',
				  data:	dewPointSeries
				}]
			});			
			
			var pressureSeries = <?php echo($pressureData) ?>
			
			$('#pressureChart').highcharts({
                 chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'line',
				  zoomType: 'x'
			   },
			   
				title: {
                    text: 'Today\'s Barometer',
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
								return Highcharts.numberFormat(this.value,0) +' hpa';
				  }
				  },
                },
                //tooltip: {
                    //crosshairs: true,
					//formatter: function() {
					//				return '<b>'+ Highcharts.dateFormat('%I:%M %p', this.x) +'</b><br/> '+ Highcharts.numberFormat(this.y,2) +' hPa';
			      //}
                //},
				
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
            });	//Pressure Graph
			
			
			var humiditySeries = <?php echo($humidityData) ?>
			
			$('#humidityChart').highcharts({
                 chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'line',
				  zoomType: 'x'
			   },
			   
				title: {
                    text: 'Today\'s Humidity',
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
					tickInterval: 10,
                    minorGridLineWidth: 0, 
					gridLineWidth: 1,
					alternateGridColor: null,
					labels: { 
					formatter: function() {
								return Highcharts.numberFormat(this.value,0) +' %'; 
				  }
				  },
                },
                //tooltip: {
                    //crosshairs: true,
					//formatter: function() {
					//				return '<b>'+ Highcharts.dateFormat('%I:%M %p', this.x) +'</b><br/> '+ Highcharts.numberFormat(this.y,2) +' %';
			      //}
               // },
			   
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
            });	//Humidity Graph
			
			var windSpeedSeries = <?php echo($windSpeedData) ?>;
			var windDirSeries = <?php echo($windDirData) ?>;
			
			$('#windChart').highcharts({
                    
			chart: {
			      //renderTo: 'container',
				  zoomType: 'x'
			   },
			   title: {
			      text: 'Today\'s Wind Speed and Direction'
			   },
			   subtitle: {
			      text: 'Click and drag in plot area to zoom in'
			   },
			   xAxis: {
			      type: 'datetime',
				minPadding: 0.02,
				maxPadding: 0.02,
			   },
 	 			  labels: {
						items: [{
							html: '',
							style: {
								left: '0px',
								top: '262px'
							}      
						}, {
							html: 'NE',
							style: {
								left: '0px',
								top: '228px'
							}
						}, {
							html: 'E',
							style: {
								left: '0px',
								top: '192px'
							}      
						}, {
							html: 'SE',
							style: {
								left: '0px',
								top: '159px'
							}
						}, {
							html: 'S',
							style: {
								left: '0px',
								top: '124px'
							}     
						}, {
							html: 'SW',
							style: {
								left: '0px',
								top: '89px'
							}
						}, {
							html: 'W',
							style: {
								left: '0px',
								top: '54px'
							}      
						}, {
							html: 'NW',
							style: {
								left: '0px',
								top: '21px'
							}
						}, {
							html: 'N',
							style: {
								left: '0px',
								top: '-15px'
							}      
						}
						]
				  },
				  yAxis: [{//Primary Axis
			      title: {
			         text: 'Wind Direction'
			      },
				  max: 360,
				  min: 0,
				  tickInterval: 45,

			   },{//Secondary Axis
			      title: {
					 enabled: true,
					 margin: 30,
			         text: 'Windspeed (km/h)'
			      },
				  min: 0,
				  opposite: true,
				  labels: { 
					formatter: function() {	return this.value +' Km/h';}
					//formatter: function() { return Highcharts.numberFormat(this.value,1) +' Km/h' } 
				  }
			   }],
			   tooltip: {
				crosshairs: true,
				shared: true,
			      formatter: function() {
						//debugger;
						var s = '<b>' + Highcharts.dateFormat('%I:%M %p', this.x) + '</b>';
						
						$.each(this.points, function(i, point) {
			                s += '<br/>' + point.series.name + ': ' + point.y + (this.series.name == 'Wind Dir' ? ' degrees' : ' km/h');
						});
						return s;
					
			      }
			   },


			   plotOptions: {
			   areaspline: {
			         pointInterval: 300000, // one hour
			         marker: {
			            enabled: false,
			            states: {
							hover: {
			                  enabled: true,
			                  symbol: 'circle',
			                  radius: 4,
			                  lineWidth: 1
							}
						}
					 },
			      },
			      spline: {
			         lineWidth: 0,
			         marker: {
			            enabled: true,
						symbol: 'square',
						radius: 3,
						//fillColor: '#222',
                        //lineWidth: 1
			         states: {
			            hover: {
			                  enabled: true,
			                  symbol: 'square',
			                  radius: 5,
							  fillColor: 'white',
							  lineColor: 'black',
			                  //lineWidth: 2
			            }
			         }
			         },
			         pointInterval: 300000, // one hour
			         
			         
			      }
				  },
			   series: [{ 
				name: 'Wind Speed',
				
				yAxis: 1,		  
				type: 'areaspline',
				data: windSpeedSeries
				
				},{
				name: 'Wind Dir',
				type: 'spline',
				//color: 'rgba(0, 0, 0, .75)',
				data: windDirSeries
				
			
			   }]
			});
			
			var rainSeries = <?php echo($rainData) ?>;	
		
			$('#rainfallChart').highcharts({
				chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'column',
			      margin: [ 50, 50, 100, 80]
			   },
			   title: {
			      text: 'Today\'s Rainfall'
			   },
			   subtitle: {
			      text: ''
			   },
			    xAxis: {
				labels: {
					align: 'center',
					style: {
						font: 'normal 9.2px Verdana, sans-serif'
					},
						formatter: function() {
							return Highcharts.dateFormat('%H:%M',this.value);
						}
				},
					type: 'datetime',
					tickInterval: 300000,//24 * 3600 * 1000,
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
			         return '<b>'+ Highcharts.dateFormat('%H:00',this.x) +'</b><br/>'+
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
			
	}); //function
	
	
	
	
	</script>

	
<?php include('nav.php'); ?>

    <div class="container">

    	<div id="tempChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <div id="pressureChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<div id="humidityChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<div id="windChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<div id="rainfallChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</div><!-- /.container -->
<?php include('footer.php'); ?>