

<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];

	if(isset($user) && isset($question) & isset($answer)){
		$sql = "INSERT INTO records (user, question, answer) VALUES ('$user', '$question', '$answer')";
		
		if ($db->query($sql) === TRUE) {
    		echo '{"Success":"Table created successfully"}';
		} else {
    		echo "Error creating table: " . $db->error;
		}

	} else {
		echo '{"error":"nothing added"}';
	}

?>

