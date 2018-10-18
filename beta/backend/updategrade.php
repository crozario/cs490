

<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$grade = $_POST['grade'];

	if(isset($user)) {
		$sql = "UPDATE record SET grade ='$grade' WHERE user = '$user'";
		
		if ($db->query($sql) === TRUE) {
       		echo '{"Success":"Entry made"}';
		}

	} else {
		echo '{"error":"nothing added"}';
	}

?>
