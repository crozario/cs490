<?php
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	
	$questionbody = rawurldecode($_POST['questionbody']);
	$difficulty = $_POST['difficulty'];
	$topic = $_POST['topic'];
	$testcasein = rawurldecode($_POST['testcasein']);
	$testcaseout = rawurldecode($_POST['testcaseout']);
	$functionName = $_POST['functionName'];
	$constraints = $_POST['constraint'];
	
	$sql = "INSERT INTO question (questionbody, difficulty, topic, testcasein, testcaseout, functionName, constraints) VALUES ('$questionbody', '$difficulty', '$topic', '$testcasein', '$testcaseout', '$functionName', '$constraints')";	
		if ($db->query($sql) === True) {
    		echo '{"Success":"Nice"}';
		} else {
			printf('{"Error":"%s"}', mysqli_error($db));
		}
	
	$db->close();

?>

