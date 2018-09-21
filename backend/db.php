<?php
//Creates a connection to server
//@param: database name
	$servername = "sql.njit.edu";
	$username = "eo65";
	$dbpassword = "bBQZFreNe";
	$dbname = "eo65";
		
	//Create connection
	$db = new mysqli($servername, $username, $dbpassword, $dbname);
?>

