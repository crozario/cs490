

<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$examname = $_POST['exam'];
	$comments = $_POST['comments'];
	$grade = $_POST['points'];

	if(isset($user)) {
		$sql = "UPDATE records SET autograde = '$grade' WHERE user = '$user' AND points IS NULL";
		
		if ($db->query($sql) === TRUE) {
       		echo '{"Success":"Entry made"}';
		}

		$sql1 = "UPDATE records SET comment = '$comments' WHERE question IS NULL";
		$db->query($sql1);

		$sql2 = "UPDATE taken SET rel = 1 WHERE exam = '$examname'";
		$db->query($sql2);

	} else {
		echo '{"error":"nothing added"}';
	}

	echo $user;
	echo $examname;
	echo $comments;
	echo $grade;

?>
