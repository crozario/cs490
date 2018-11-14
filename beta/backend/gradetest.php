
<?php
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	//$arr1 = array();
	$examname = $_POST['exam'];
	$sql = "SELECT DISTINCT examquestionlist.exam, examquestionlist.points, examquestionlist.question, question.testcasein, question.testcaseout, question.functionName, question.constraints FROM question INNER JOIN examquestionlist ON question.questionbody=examquestionlist.question WHERE examquestionlist.exam = '$examname'";
		
	if ($db->query($sql) == True) {
		$arr = array();
		$result = $db->query($sql);

		while ($row = $result->fetch_assoc()) {
			//printf('{"questionbody": "%s", "difficulty":"%s", "topic":"%s"}', $row['questionbody'], $row['difficulty'], $row['topic']);
			array_push($arr, $row);	
		}

		$json = json_encode($arr);
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
