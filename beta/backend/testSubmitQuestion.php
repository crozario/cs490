

<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$answer = $_POST['answer'];
	$examid = $_POST['exam'];
	$question = $_POST['question'];

	$sql = "UPDATE record SET t1 = 1";
	
	if ($db->query($sql) === TRUE) {
    	echo '{"Success":"Test submitted successfully"}';
	} else {
    	printf('{"Error":"%s"}', $db->error);
	}	

	
	$sql = "INSERT INTO records (user, exam, question, answer) VALUES ('$user', '$examid','$question', '$answer')";
		
	if ($db->query($sql) === TRUE) {
    	echo '{"Success":"Submittion successfull"}';

    	$sql = "SELECT * FROM records";
		$result = $db->query($sql);

		
		if ($result->num_rows > 0) {
    		echo "<table><tr><th>user</th><th>points</th><th>exam</th><th>testcasesin</th><th>testcasesout</th><th>expectedtestcaseout</th><th>question</th><th>answer</th></tr>";
    	// output data of each row
    		while($row = $result->fetch_assoc()) {
        		echo "<tr><td>" . $row["user"]. "</td><td>" . $row["points"]. "</td><td>" . $row["exam"]. "</td><td>" . $row["testcasesin"]. "</td><td>" . $row["testcasesout"]. "</td><td>" . $row["expectedtestcaseout"]. "</td><td>" . $row["question"]. "</td><td>" . $row["answer"]. "</td></tr>";
    		}
    		echo "</table>";
    	} 
		else {
    		echo "0 results";
		}
	} else {
    	printf('{"Error adding":"%s"}', $db->error);
	}



?>

