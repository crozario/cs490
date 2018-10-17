<?php
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$examname = $_POST['examname'];
	$num = $_POST['num'];

	$result = mysqli_query($db, "SELECT testcases FROM $examname WHERE num = '$num'");
	if (mysqli_num_rows($result) == 1) {
       	$row = $result->fetch_assoc();
       	echo $row['testcases'];
	}
	else {
		echo '{"denied":"Wrong username or password"}';
	}
?>