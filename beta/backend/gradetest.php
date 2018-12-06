
<?php
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$examname = $_POST['exam'];
	
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
   			$sql1 = "SELECT DISTINCT examquestionlist.exam, examquestionlist.points, examquestionlist.question, question.testcasein, question.testcaseout, question.functionName, question.constraints FROM question INNER JOIN examquestionlist ON question.questionbody=examquestionlist.question WHERE question = '$question' AND exam = '$examname'";
   			$result1 = $db->query($sql1);
   			$row1 = $result1->fetch_assoc();
   			array_push($arr1, $row1);
   		}
		
		$json = json_encode($arr1);
		echo $json;
	} else {
		printf('{"Error":"%s"}\n', mysqli_error($db));
	}

	//$result = mysqli_query($db, "SELECT DISTINCT examquestionlist.question, records.answer, examquestionlist.points, question.testcasein, question.testcaseout, question.functionName, question.constraints FROM question, examquestionlist, records WHERE records.exam = '$examname' and question.questionbody=examquestionlist.question and records.user = '$user'");

	/*while ($row = $result1->fetch_assoc()) {
		printf('[{"exam":"%s","points": "%s", "points":"%s", "testcasein":"%s", "testcaseout":"%s", }]', $row['exam'], $row['points'], $row['testcasein'], $row['testcaseout']);	
	}*/


	$db->close();

?>
