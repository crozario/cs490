<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$examid = $_POST['exam'];


	$arr = array();
	$sql = "SELECT DISTINCT * FROM records WHERE user = '$user' && exam = '$examid' && points IS NOT NULL";
	$result = $db->query($sql);
	
	while ($row = $result->fetch_assoc()) {
		//printf('{"exam": "%s"}', $row['exam']);
		array_push($arr, $row);	
	}

	$json = json_encode($arr);
	echo $json;

	/*
	if ($result->num_rows > 0) {
    	echo "<table><tr><th>user</th><th>points</th><th>exam</th><th>testcasesin</th><th>testcasesout</th><th>expectedtestcaseout</th><th>question</th><th>answer</th></tr>";
    	// output data of each row
    	while($row = $result->fetch_assoc()) {
        	echo "<tr><td>" . $row["user"]. "</td><td>" . $row["points"]. "</td><td>" . $row["exam"]. "</td><td>" . $row["testcasesin"]. "</td><td>" . $row["testcasesout"]. "</td><td>" . $row["expectedtestcaseout"]. "</td><td>" . $row["question"]. "</td><td>" . $row["answer"]. "</td></tr>";
    		}
    	echo "</table>";
    }
    ?*/

    $db->close();
?>