<?php

include "db.php";
	
if ($db->connect_error) {
	die('Connection failed: ' . $db->connect_error);
}
		
//$response = file_get_contents('php://input');

$sql3 = "TRUNCATE TABLE examquestionlist";
$db->query($sql3);

$sql4 = "TRUNCATE TABLE records";
$db->query($sql4);

$sql = "TRUNCATE TABLE taken";
$db->query($sql);
		
$examName = $_POST['examName'];
$question = $_POST['question'];
$points = $_POST['points'];
 
if(isset($examName) && isset($question) & isset($points)){
	$sql = "INSERT INTO examquestionlist (exam, question, points) VALUES (urldecode('$examName'), '$question', '$points')";
	if ($db->query($sql) === TRUE) {
    		echo var_dump($_POST['points']);
	} else {
    		echo "Error creating table: " . $db->error;
	}

	$sql = "INSERT INTO taken (user, exam) SELECT DISTINCT Login.user, examquestionlist.exam FROM Login, examquestionlist WHERE Login.role = 'student' AND examquestionlist.exam = '$examName'";
	$db->query($sql);
}
else {
	echo '{"error":"nothing added"}';
}




$db->close();

?>
