<?php
/*
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$examname = $_POST['exam'];

	$arr = array();
	$sql = "SELECT * FROM records WHERE testcasesout IS NOT NULL AND user = '$user' AND exam = '$examname'";
	$result = $db->query($sql);

	while ($row = $result->fetch_assoc()) {
		//printf('{"questionbody": "%s", "difficulty":"%s", "topic":"%s"}', $row['questionbody'], $row['difficulty'], $row['topic']);
		array_push($arr, $row);	
	}

	$json = json_encode($arr);
	echo $json;

	$db->close();
*/	

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$examname = $_POST['exam'];
	$user = $_POST['user'];

	$arr = array();
	$arr1 = array();
	
	$sql = "SELECT DISTINCT question FROM examquestionlist";
		
	if ($db->query($sql) == True) {
		$result = $db->query($sql);

		while ($row = $result->fetch_assoc()) {
			//printf('{"questionbody": "%s", "difficulty":"%s", "topic":"%s"}', $row['questionbody'], $row['difficulty'], $row['topic']);
			array_push($arr, $row);	
		}

		for ($i = 0; $i < count($arr); $i++) {
   			$question = $arr[$i]['question'];
   			$sql1 = "SELECT * FROM records WHERE testcasesout IS NOT NULL AND user = '$user' AND exam = '$examname' AND question = '$question'";
   			$result1 = $db->query($sql1);

   			while ($row1 = $result1->fetch_assoc()) {
				//printf('{"questionbody": "%s", "difficulty":"%s", "topic":"%s"}', $row['questionbody'], $row['difficulty'], $row['topic']);
				array_push($arr1, $row1);	
			}
   		}
		
		$json = json_encode($arr1);
		echo $json;
	} else {
		printf('{"Error":"%s"}\n', mysqli_error($db));
	}


	$db->close();

?>