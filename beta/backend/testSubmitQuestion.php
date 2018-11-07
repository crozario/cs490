

<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$answer = $_POST['answer'];
	$examid = $_POST['exam'];	

	
	$sql = "INSERT INTO records (user, exam, answer) VALUES ('$user', '$examid', '$answer')";
		
	if ($db->query($sql) === TRUE) {
    	echo '{"Success":"Submittion successfull"}';

    	$sql = "SELECT distinct * FROM records";
		$result = $db->query($sql);

		
		if ($result->num_rows > 0) {
    		echo "<table><tr><th>user</th><th>points</th><th>exam</th><th>testcasesin</th><th>testcasesout</th><th>expectedtestcaseout</th><th>question</th><th>answer</th><th>autograde</th><th>updategrade</th><th>comment</th><th>release</th></tr>";
    	// output data of each row
    		while($row = $result->fetch_assoc()) {
        		echo "<tr><td>" . $row["user"]. "</td><td>" . $row["points"]. "</td><td>" . $row["exam"]. "</td><td>" . $row["testcasesin"]. "</td><td>" . $row["testcasesout"]. "</td><td>" . $row["expectedtestcaseout"]. "</td><td>" . $row["question"]. "</td><td>" . $row["answer"]. $row["autograde"]. "</td><td>" .  $row["updategrade"]. "</td><td>" . $row["comment"] . "</td><td>" . $row["rel"] ."</td></tr>";
    		}
    		echo "</table>";
    	} 
	} else {
    	printf('{"Error adding":"%s"}', $db->error);
	}

	$db->close();


?>

