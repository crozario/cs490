<?php
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$examname = 'exam2';//$_POST['examname'];
	
	$sql = "CREATE TABLE $examname ( 
	num int NOT NULL AUTO_INCREMENT, 
	difficutly int NOT NULL, 
	points int NOT NULL, 
	question varchar(1000) NOT NULL, 
	correctans varchar(1000) NOT NULL, 
	testcases varchar(1000) NOT NULL, 
	PRIMARY KEY (num) 
)";

	if (mysqli_query($db, $sql)) {
    	echo '{"Success":"Table created successfully"}';
		$sql = "INSERT INTO examlist (exam) VALUES ('$examname')";

		if ($db->query($sql) === TRUE) {
    		echo '{"Success":"New record created successfully"}';
		} else {
    		printf('{"Error":"%s"}', mysqli_error($db));
		}	
	} else {
    	printf('{"Error":"%s"}', mysqli_error($db));
	}

	mysqli_close($conn);
?>

