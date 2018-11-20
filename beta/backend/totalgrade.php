<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}
	
	$examname = $_POST['exam'];
	$user = $_POST['user'];

	$arr = array();
	$result = mysqli_query($db, "SELECT DISTINCT * FROM taken WHERE user = '$user' AND exam = '$examname' WHERE rel = 1");

	while ($row = $result->fetch_assoc()) {
		//printf('{"exam": "%s"}', $row['exam']);
		array_push($arr, $row);	
	}

	$json = json_encode($arr);
	echo $json;

	$db->close();

?>