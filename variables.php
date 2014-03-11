<?php

include('connect.php');

	class Variables
	{

		function GetVariable($name)
		{
			$sql = "SELECT value FROM settings WHERE name = '$name' LIMIT 0, 30 ";
	  		$result = mysql_query($sql);

	  		while ( $db_field = mysql_fetch_assoc($result) ) {
	  			return $db_field['value'];
	  		}
		}
	}



?>