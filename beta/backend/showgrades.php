

<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$examname = $_POST['examname'];

	if(isset($user) && isset($examname)) {
		$result = mysqli_query($db, "SELECT DISTINCT exam, question FROM record WHERE user = '$user'");
		
		if (mysqli_num_rows($result) > 1) {
       		$row = $result->fetch_assoc();
       		printf('{"grade":"%s"}', $row['grade']);
		}

	} else {
		echo '{"error":"nothing added"}';
	}
	
?>