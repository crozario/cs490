<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$points = $_POST['points'];
	$examid = $_POST['exam'];
	$testcasesin = rawurldecode($_POST['testcasesin']);
	$testcasesout = rawurldecode($_POST['testcasesout']);
	$expectedtestcaseout = rawurldecode($_POST['expectedtestcaseout']);
	$question = rawurldecode($_POST['question']);
	$answer = rawurldecode($_POST['answer']);
	$totalgrade = $_POST['autograde'];


	$sql = "INSERT INTO records (user, points, exam, testcasesin, testcasesout, expectedtestcasesout, question, answer, autograde) VALUES ('$user', '$points', '$examid', '$testcasesin', '$testcasesout', '$expectedtestcaseout', '$question', '$answer', '$totalgrade')";
		
	if ($db->query($sql) === TRUE) {
    	//echo '{"Success":"Submittion successfull"}';

		/*
    	$sql1 = "UPDATE records SET autograde = autograde + '$points' WHERE user = '$user' AND points = 'NULL'";
    	$db->query($sql1); */

		$sql3 = "UPDATE records SET autograde = autograde + '$totalgrade' WHERE user = '$user' AND testcasesin IS NULL AND answer = '$answer'";
		$db->query($sql3);

		$arr1 = array();
		//$sql5 = "SELECT DISTINCT autograde FROM records WHERE user = '$user' AND answer = '$answer' AND points IS NULL AND autograde IS NOT NULL";
		$t = 0;
		$sql5 = "SELECT DISTINCT answer, autograde FROM records WHERE testcasesout IS NULL AND testcasesin IS NULL";
		$result5 = $db->query($sql5);
    	while($row5 = $result5->fetch_assoc()) {
        	$arr1[] = $row5;		 
    	}
   		
   		for ($i = 0; $i <= count($arr1); $i++) {
   			$t = $t + $arr1[$i]['autograde'];
   			//echo $arr1[$i]['autograde'];
   		}
   		//echo $t;

   		$sql4 = "UPDATE taken SET graded = '$t' WHERE user = '$user'";
		$db->query($sql4);

		//$e = json_encode($newArray);
		//echo $e;

		/*if ($result->num_rows > 0) {
    		echo "<table><tr><th>user</th><th>points</th><th>exam</th><th>testcasesin</th><th>testcasesout</th><th>expectedtestcaseout</th><th>question</th><th>answer</th><th>autograde</th></tr>";
    	// output data of each row
    		while($row = $result->fetch_assoc()) {
        		echo "<tr><td>" . $row["user"]. "</td><td>" . $row["points"]. "</td><td>" . $row["exam"]. "</td><td>" . $row["testcasesin"]. "</td><td>" . $row["testcasesout"]. "</td><td>" . $row["expectedtestcaseout"]. "</td><td>" . $row["question"]. "</td><td>" . $row["answer"]. "</td><td>" . $row["autograde"]. "</td></tr>";
    		}
    		echo "</table>";
    	}*/ 
	} else {
    	printf('{"Error adding":"%s"}', $db->error);
	}
?>
