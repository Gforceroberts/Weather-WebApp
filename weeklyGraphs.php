<?php include('header.php'); ?>

<?php

    $today = date("Y-m-d", time() - 60 * 60 * 24 * 3);
	$sevenDaysAgo = date("Y-m-d", time() - 60 * 60 * 24 * 6);

    //weekly temp date
	$SQL = "SELECT DATE(date) as myDate, HOUR(date) as hour, max(temp) as maxTemp FROM `mydata` WHERE  `date` >= '2014-02-18' AND `date` <= '2014-02-19' group by DATE(date), HOUR(date)";
  	$weeklyMaxTempData = mysql_query($SQL);
  	while ($row = mysql_fetch_array($weeklyMaxTempData)) {

	   $data_weeklyMaxTempCats[] = $row['hour'];
	   $data_maxValues[] = $row['maxTemp'];
	}

	
	
	
?>

	<script type="text/javascript"> 
	
        
		$(function () {

    		var weeklyCats = [ <?php echo join($data_weeklyMaxTempCats, ',') ?> ]
    		var weeklyMaxData = [ <?php echo join($data_maxValues, ',') ?> ]
			
			$('#weeklyTempChart').highcharts({
                
				title: {
                    text: 'Weekly Max Temperature',
                    x: -20 //center
                },
                xAxis: {
                    categories: weeklyCats
					//min: 4
					
                },
				legend: {
					verticalAlign: 'top',
					y: 100,
					align: 'right'
				},
    
				//scrollbar: {
				//enabled: true
				//},
				
				
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
                    data: weeklyMaxData
                				
				}]
				
				
            });

        });


		</script>

  <?php include('nav.php'); ?>

    <div class="container">

    	
		<div id="weeklyTempChart" style="height: 300px"></div>
        

	</div><!-- /.container -->
<?php include('footer.php'); ?>