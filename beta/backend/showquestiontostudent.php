
<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$examname = $_POST['examname'];
	$question = $_POST['question'];

	if(isset($examname) && isset($question)) {
		$result = mysqli_query($db, "SELECT DISTINCT exam, question FROM examquestionlist WHERE examname = '$examname' && question = '$question'");
		
		if (mysqli_num_rows($result) > 1) {
       		$row = $result->fetch_assoc();
       		printf('{"exam":"%s","question":"%s"}', $row['exam'], $row['question']);
		}

	} else {
		echo '{"error":"nothing added"}';
	}

?>
