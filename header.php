<?php include('variables.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

        <title>Forcecast</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/site.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="http://code.highcharts.com/stock/highstock.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
		<script src="http://code.highcharts.com/highcharts-more.js"></script>



        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

<?php
    function get_time_ago($time_stamp)
{
    $time_difference = strtotime('now') - $time_stamp;

    if ($time_difference >= 60 * 60 * 24 * 365.242199)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 365.242199 days/year
         * This means that the time difference is 1 year or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 365.242199, 'year');
    }
    elseif ($time_difference >= 60 * 60 * 24 * 30.4368499)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 30.4368499 days/month
         * This means that the time difference is 1 month or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 30.4368499, 'month');
    }
    elseif ($time_difference >= 60 * 60 * 24 * 7)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 7 days/week
         * This means that the time difference is 1 week or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 7, 'week');
    }
    elseif ($time_difference >= 60 * 60 * 24)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day
         * This means that the time difference is 1 day or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24, 'day');
    }
    elseif ($time_difference >= 60 * 60)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour
         * This means that the time difference is 1 hour or more
         */
        return get_time_ago_string($time_stamp, 60 * 60, 'hour');
    }
    else
    {
        /*
         * 60 seconds/minute
         * This means that the time difference is a matter of minutes
         */
        return get_time_ago_string($time_stamp, 60, 'minute');
    }
}

function get_time_ago_string($time_stamp, $divisor, $time_unit)
{
    $time_difference = strtotime("now") - $time_stamp;
    $time_units      = floor($time_difference / $divisor);

    settype($time_units, 'string');

    if ($time_units === '0')
    {
        return 'less than 1 ' . $time_unit . ' ago';
    }
    elseif ($time_units === '1')
    {
        return '1 ' . $time_unit . ' ago';
    }
    else
    {
        /*
         * More than "1" $time_unit. This is the "plural" message.
         */
        // TODO: This pluralizes the time unit, which is done by adding "s" at the end; this will not work for i18n!
        return $time_units . ' ' . $time_unit . 's ago';
    }
}
?>
