<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}
	
	$arr = array();
	$result = mysqli_query($db, "SELECT DISTINCT * FROM records");

	while ($row = $result->fetch_assoc()) {
		//printf('{"exam": "%s"}', $row['exam']);
		array_push($arr, $row);	
	}

	$json = json_encode($arr);
	echo $json;

	$db->close();

?>