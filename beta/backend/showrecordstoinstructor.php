<?php
	
	include "db.php";
	
	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$arr = array();
	$sql = "SELECT distinct * FROM records";
	$result = $db->query($sql);

	while ($row = $result->fetch_assoc()) {
		//printf('{"questionbody": "%s", "difficulty":"%s", "topic":"%s"}', $row['questionbody'], $row['difficulty'], $row['topic']);
		array_push($arr, $row);	
	}

	$json = json_encode($arr);
	echo $json;

	$db->close();
?>
