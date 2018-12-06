

<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$examname = $_POST['exam'];
	$grade = rawurldecode($_POST['points']);
	$comments = rawurldecode($_POST['comments']);
	$question = rawurldecode($_POST['question']);

	if(isset($user)) {
		$sql = "UPDATE records SET autograde = '$grade' WHERE user = '$user' AND testcasesout IS NULL AND question = '$question'";
		$db->query($sql);
		

		$sql1 = "UPDATE records SET comment = '$comments' WHERE user = '$user' AND testcasesout IS NULL AND question = '$question'";
		$db->query($sql1);

		$arr1 = array();
		$t = 0;
		$p = 0;
		$sql5 = "SELECT DISTINCT points, question, autograde FROM records WHERE testcasesout IS NULL AND autograde IS NOT NULL AND user = '$user'";
		$result5 = $db->query($sql5);
    	while($row5 = $result5->fetch_assoc()) {
        	$arr1[] = $row5;		 
    	}
   		
   		for ($i = 0; $i <= count($arr1); $i++) {
   			$t = $t + $arr1[$i]['autograde'];
   			$p = $p + $arr1[$i]['points'];
   		}
   		$grade = ($t/$p)*100;

   		$sql4 = "UPDATE taken SET graded = '$grade' WHERE user = '$user' and exam = '$examname'";
		$db->query($sql4);

		$sql2 = "UPDATE taken SET rel = 1 WHERE exam = '$examname' and user = '$user'";
		$db->query($sql2);

	} else {
		echo '{"error":"nothing added"}';
	}

?>
