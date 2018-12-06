

<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$examid = $_POST['exam'];
	$points = $_POST['points'];
	$question = rawurldecode($_POST['question']);
	$answer = rawurldecode($_POST['answer']);	


	$arr = array();
	$sql = "REPLACE INTO records (user, points, exam, question, answer) VALUES ('$user', '$points', '$examid', '$question', '$answer')";
		
	if ($db->query($sql) === TRUE) {
    //	echo '{"Success":"Submittion successfull"}';

    	$sql = "SELECT DISTINCT * FROM records";
		$result = $db->query($sql);

    	$json = json_encode($arr);
		echo $json;
    //	} 
	} else {
   		printf('{"Error adding":"%s"}', $db->error);
	}

	$sql1 = "UPDATE taken SET tk = 1 WHERE exam = '$examid' and user = '$user'";
	$db->query($sql1);
	
?>

