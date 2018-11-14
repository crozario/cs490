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
	$totalgrade = $_POST['autograde'];


	$sql = "INSERT INTO records (user, points, exam, testcasesin, testcasesout, expectedtestcasesout, question, answer, autograde) VALUES ('$user', '$points', '$examid', '$testcasesin', '$testcasesout', '$expectedtestcaseout', '$question', '$answer', $totalgrade)";
		
	if ($db->query($sql) === TRUE) {
    	//echo '{"Success":"Submittion successfull"}';

		/*
    	$sql1 = "UPDATE records SET autograde = autograde + '$points' WHERE user = '$user' AND points = 'NULL'";
    	$db->query($sql1); */

    	$sql = "SELECT DISTINCT * FROM records";
		$result = $db->query($sql);

		$sql3 = "UPDATE taken SET graded = graded + '$points' WHERE user = '$user'";
		$db->query($sql3);
		
		
		if ($result->num_rows > 0) {
    		echo "<table><tr><th>user</th><th>points</th><th>exam</th><th>testcasesin</th><th>testcasesout</th><th>expectedtestcaseout</th><th>question</th><th>answer</th><th>autograde</th></tr>";
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