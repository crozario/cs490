<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$points = $_POST['points'];
	$examid = $_POST['exam'];
	$testcasesin = $_POST['testcasesin'];
	$testcasesout = $_POST['testcasesout'];
	$expectedtestcaseout = $_POST['expectedtestcaseout'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];


	$sql = "INSERT INTO records (user, points, exam, testcasesin, testcasesout, expectedtestcasesout, question, answer) VALUES ('$user', '$points', '$examid', '$testcasesin', '$testcasesout', '$expectedtestcaseout', '$question', '$answer')";
		
	if ($db->query($sql) === TRUE) {
    	echo '{"Success":"Submittion successfull"}';

    	$sql = "UPDATE records SET autograde = autograde + '$points' WHERE user = '$user' and points = 0";
    	$result = $db->query($sql);

    	$sql = "SELECT distinct * FROM records";
		$result = $db->query($sql);

		
		if ($result->num_rows > 0) {
    		echo "<table><tr><th>user</th><th>points</th><th>exam</th><th>testcasesin</th><th>testcasesout</th><th>expectedtestcaseout</th><th>question</th><th>answer</th></tr>";
    	// output data of each row
    		while($row = $result->fetch_assoc()) {
        		echo "<tr><td>" . $row["user"]. "</td><td>" . $row["points"]. "</td><td>" . $row["exam"]. "</td><td>" . $row["testcasesin"]. "</td><td>" . $row["testcasesout"]. "</td><td>" . $row["expectedtestcaseout"]. "</td><td>" . $row["question"]. "</td><td>" . $row["answer"]. "</td><td>" . $row["autograde"]. "</td></tr>";
    		}
    		echo "</table>";
    	} 
	} else {
    	printf('{"Error adding":"%s"}', $db->error);
	}
?>