<?php
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$examname = $_POST['examname'];
	$difficulty = $_POST['difficulty'];
	$points = $_POST['points'];
	$question = $_POST['question'];
	$partans = $_POST['partans'];
	$testcases = $_POST['testcases'];

	$sql = "INSERT INTO $examname (difficulty, points, question, partans, testcases) VALUES ('$difficulty', '$points', '$question', '$partans', '$testcases')";

	if ($db->query($sql) === TRUE) {
    	echo '{"Success":"New record created successfully"}';
	} else {
    	printf('{"Error":"%s"}', mysqli_error($db));
	}

	$db->close();

?>