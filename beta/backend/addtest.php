<?php

include "db.php";
	
if ($db->connect_error) {
	die('Connection failed: ' . $db->connect_error);
}
		
//$response = file_get_contents('php://input');
		
$examName = $_POST['examName'];
$question = $_POST['question'];
$points = $_POST['points'];

if(isset($examName) && isset($question) & isset($points)){
	$sql = "INSERT INTO examquestionlist (exam, question, points) VALUES ('$examName', '$question', '$points')";
	if ($db->query($sql) === TRUE) {
    		echo var_dump($_POST['points']);
	} else {
    		echo "Error creating table: " . $db->error;
	}

	//$sql = "INSERT INTO taken (user, exam) SELECT DISTINCT Login.user, examquestionlist.exam FROM Login, examquestionlist WHERE Login.role = 'student' AND examquestionlist.exam = '$examName'";
	//$db->query($sql);
}
else {
	echo '{"error":"nothing added"}';
}




$db->close();

?>
