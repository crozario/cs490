<?php

include "db.php";
	
if ($db->connect_error) {
	die('Connection failed: ' . $db->connect_error);
}
		
//$response = file_get_contents('php://input');

//$sql1 = "SELECT * FROM taken";
//$db->query($sql1);
//$sql2 = "TRUNCATE TABLE records";
//$sql3 = "TRUNCATE TABLE taken";

//$db->query($sql2);
//$db->query($sql3);
//$sql5 = "INSERT INTO taken (user, exam) SELECT DISTINCT Login.user, examquestionlist.exam FROM Login, examquestionlist WHERE Login.role = 'student' AND examquestionlist.exam = '$examName'";
//$sql6 = "TRUNCATE TABLE examquestionlist";
//$db->query($sql6);

$examName = $_POST['examName'];
$question = urldecode($_POST['question']);
$points = $_POST['points'];
 
if(isset($examName) && isset($question) & isset($points)){
	$sql4 = "INSERT INTO examquestionlist (exam, question, points) VALUES ('$examName', '$question', '$points')";
	if ($db->query($sql4) === TRUE) {
    		echo var_dump($_POST['points']);
	} else {
    		echo "Error creating table: " . $db->error;
	}

	$sql5 = "INSERT INTO taken (user, exam) SELECT DISTINCT Login.user, examquestionlist.exam FROM Login, examquestionlist WHERE Login.role = 'student' AND examquestionlist.exam = '$examName'";
	$db->query($sql5);
}
else {
	echo '{"error":"nothing added"}';
}




$db->close();

?>
