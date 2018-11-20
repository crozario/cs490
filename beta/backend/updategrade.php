

<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$examname = $_POST['exam'];
	$comments = $_POST['comments'];
	$answer = rawurldecode($_POST['answer']);
	$grade = $_POST['points'];

	if(isset($user)) {
		$sql = "UPDATE records SET autograde = '$grade' WHERE user = '$user' AND testcasesin IS NULL AND answer = '$answer'";
		$db->query($sql);
		

		$sql1 = "UPDATE records SET comment = '$comments' WHERE user = '$user' AND testcasesin IS NULL AND answer = '$answer'";
		$db->query($sql1);

		$arr1 = array();
		//$sql5 = "SELECT DISTINCT autograde FROM records WHERE user = '$user' AND answer = '$answer' AND points IS NULL AND autograde IS NOT NULL";
		$t = 0;
		$sql5 = "SELECT DISTINCT answer, autograde FROM records WHERE testcasesin IS NULL AND autograde IS NOT NULL";
		$result5 = $db->query($sql5);
    	while($row5 = $result5->fetch_assoc()) {
        	$arr1[] = $row5;		 
    	}
   		
   		for ($i = 0; $i <= count($arr1); $i++) {
   			$t = $t + $arr1[$i]['autograde'];
   		}
   		echo $t;

   		$sql4 = "UPDATE taken SET graded = '$t' WHERE user = '$user'";
		$db->query($sql4);

		$sql2 = "UPDATE taken SET rel = 1 WHERE exam = '$examname'";
		$db->query($sql2);

	} else {
		echo '{"error":"nothing added"}';
	}

?>
