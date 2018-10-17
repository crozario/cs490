<?php
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$examname = 'exam1';//$_POST['examname'];
	$difficulty = 3;//$_POST['difficulty'];
	$points = 10;//$_POST['points'];
	$question = 'create an adding function';//$_POST['question'];
	$partans = 'add(a,b)';//$_POST['partans'];
	$testcases = '{"input":[1,2,3], "output":[1,4,3]}';//$_POST['testcases'];

	$sql = "INSERT INTO $examname (difficulty, points, question, partans, testcases) VALUES ('$difficulty', '$points', '$question', '$partans', '$testcases')";

	if ($db->query($sql) === TRUE) {
    	echo '{"Success":"New record created successfully"}';
	} else {
    	printf('{"Error":"%s"}', mysqli_error($db));
	}

	$conn->close();

?>