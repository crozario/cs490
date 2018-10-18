
<?php 
	
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$sql = "UPDATE record SET rel = 1";
		
	if ($db->query($sql) === TRUE) {
       	echo '{"Success":"Entry made"}';
	} else {
		echo '{"error":"nothing added"}';
	}
?>
