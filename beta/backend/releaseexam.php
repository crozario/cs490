<?php 
	
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$examname = $_POST['exam'];

	$sql = "UPDATE taken SET rel = 1 WHERE exam = '$examname'";

	if ($db->query($sql) === TRUE) {
       	echo '{"Success":"Entry made"}';
	} else {
		echo '{"Error":"Nothing added"}';
	}

	$db->close();
?>
