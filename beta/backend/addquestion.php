<?php
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	
	$questionbody = $_POST['questionbody'];
	$difficulty = $_POST['difficulty'];
	$topic = $_POST['topic'];
	$testcasein = $_POST['testcasein'];
	$testcaseout = $_POST['testcaseout'];
	$functionName = $_POST['functionName']

	$sql = "INSERT INTO question (questionbody, difficulty, topic, testcasein, testcaseout, functionName) VALUES ('$questionbody', '$difficulty', '$topic', '$testcasein', '$testcaseout', '$functionName')";

	if ($db->query($sql) === TRUE) {
    	echo '{"Success":"New record created successfully"}';
	} else {
    	printf('{"Error":"%s"}', mysqli_error($db));
	}

	$db->close();

?>

