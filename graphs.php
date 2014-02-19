<?php include('header.php'); ?>

<?php
			$SQL = "SELECT HOUR(date) as hour, max(temp) as temp FROM `mydata` WHERE  `date` >= '2014-02-19' group by HOUR(date)";

          	$maxHourlyTempData = mysql_query($SQL);
          	while ($row = mysql_fetch_array($maxHourlyTempData)) {

			   $data_cats[] = $row['hour'];
			   $data_values[] = $row['temp'];
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
                    color: '#808080'
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
    });


		</script>


  <?php include('nav.php'); ?>

    <div class="container">

    	<div id="tempChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</div><!-- /.container -->
<?php include('footer.php'); ?>