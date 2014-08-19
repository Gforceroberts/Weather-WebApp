<?php include('header.php'); ?>

<?php

    $today = date("Y-m-d", time() + 60 * 60 * 24);
	$yesterday = date("Y-m-d", time());

    //latest temp data
	$SQL = "select date, temp from mydata order by id desc limit 1";
  	$currentTemp = mysql_query($SQL);
  	while ($row = mysql_fetch_array($currentTemp)) {

	   $data_temp[] = $row['temp'];
	   $last_date = $row['date'];

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

	//latest wind directio data
	$SQL = "select date, winddir from mydata order by id desc limit 1";
  	$currentWindDir = mysql_query($SQL);
  	while ($row = mysql_fetch_array($currentWindDir)) {

	   switch ($row['winddir']) {
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
		$data_winddir = array();
		array_push($data_winddir, $winddir);
	   //$data_winddir = [($winddir)];
	   //echo(json_encode($data_winddir, JSON_NUMERIC_CHECK));
	}
	//latest pressure data
	$SQL = "select date, windspeed from mydata order by id desc limit 1";
  	$currentWindSpeed = mysql_query($SQL);
  	while ($row = mysql_fetch_array($currentWindSpeed)) {

	   $data_windspeed[] = $row['windspeed'];
	   //echo(json_encode($data_windspeed, JSON_NUMERIC_CHECK));
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


			Highcharts.setOptions({
				global: {
					useUTC: false
						}
			});


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
	    credits: {
			enabled: false
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
	    credits: {
			enabled: false
		},

	    yAxis: [{

	        min: 840,
	        max: 1050,
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
	    credits: {
			enabled: false
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

	function(chart) {

	});

			var winddirection = [ <?php echo join($data_winddir, ',') ?> ]

			$('#windDirGuage').highcharts({

			chart: {
	        type: 'gauge',
	        alignTicks: false,
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: false
	    },

	    title: {
	        text: 'Current Wind Direction'
	    },

	    pane: {
	        startAngle: 0,
	        endAngle: 360
	    },
	    credits: {
			enabled: false
		},

	    yAxis: [{

	        min: 0,
	        max: 360,
	        tickPosition: 'outside',
	        lineColor: '#933',
	        lineWidth: 2,
	        minorTickPosition: 'outside',
	        tickColor: '#999',
	        minorTickColor: '#933',
	        tickLength: 10,
	        minorTickLength: 5,
			tickInterval:45,
			//tickPositions: [0,45,90,135,180,225,270,315],
	        //labels: {
	            //distance: 20,
	            //rotation: 'auto'
	        //},
			labels: {
                distance: 15,
				rotation: 'auto',
                formatter:function(){
                    if(this.value == 360) { return 'N'; }
                    else if(this.value == 45) { return 'NE'; }
                    else if(this.value == 90) { return 'E'; }
                    else if(this.value == 135) { return 'SE'; }
                    else if(this.value == 180) { return 'S'; }
                    else if(this.value == 225) { return 'SW'; }
                    else if(this.value == 270) { return 'W'; }
                    else if(this.value == 315) { return 'NW'; }
                }
            },
	        offset: -20,
	        endOnTick: false
	    }],

	    series: [{
	        name: 'Wind Direction',
	        data: winddirection,
	        dataLabels: {
	            formatter: function () {
	                var windDirLabel = winddirection;
	                if(windDirLabel == 360) { return 'N'; }
                    else if(windDirLabel == 45) { return 'NE'; }
                    else if(windDirLabel == 90) { return 'E'; }
                    else if(windDirLabel == 135) { return 'SE'; }
                    else if(windDirLabel == 180) { return 'S'; }
                    else if(windDirLabel == 225) { return 'SW'; }
                    else if(windDirLabel == 270) { return 'W'; }
                    else if(windDirLabel == 315) { return 'NW'; }
					return '<span style="color:#339">'+ windDirLabel + '</span>';
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

	function(chart) {

	});

			var wind = [ <?php echo join($data_windspeed, ',') ?> ]

			$('#windSpeedGuage').highcharts({

			chart: {
	        type: 'gauge',
	        alignTicks: false,
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: false
	    },

	    title: {
	        text: 'Current Wind Speed'
	    },

	    pane: {
	        startAngle: -150,
	        endAngle: 150
	    },
	    credits: {
			enabled: false
		},

	    yAxis: [{

	        min: 0,
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
	        name: 'Wind Speed',
	        data: wind,
	        dataLabels: {
	            formatter: function () {
	                var windSpeedLabel = wind;
	                return '<span style="color:#339">'+ windSpeedLabel + ' km/h</span>';
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
	            valueSuffix: ' km/h'
	        }
	    }]

	},


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
				credits: {
				      enabled: false
				  },
				series: [{
					name: 'Today\'s Rainfall',
					data: rainData


				}]
			});



});


		</script>

  <?php include('nav.php'); ?>

    <div class="container">
    	<div class="row">
			<!--<p class="bg-primary">Last Updated: <?php // echo date("l jS \of F Y h:i:s A", strtotime($last_date)); ?></p>-->
			<h4>Last Updated: <?php echo get_time_ago(strtotime($last_date)); ?></h4>
    	</div>

    	<div class="row">
    		<div class="col-sm-4 col-xs-6">
    			<div id="tempGuage"></div>
    		</div>
    		<div class="col-sm-4 col-xs-6">
    			<div id="pressureGuage"></div>
    		</div>
    		<div class="col-sm-4 col-xs-6">
    			<div id="humidityGuage"></div>
    		</div>
    		<div class="col-sm-4 col-xs-6">
    			<div id="windDirGuage"></div>
    		</div>
    		<div class="col-sm-4 col-xs-6">
    			<div id="windSpeedGuage"></div>
    		</div>
    		<div class="col-sm-4 col-xs-6">
    			<div id="rainfall"></div>
    		</div>
    	</div>

	</div><!-- /.container -->
<?php include('footer.php'); ?>