
<?php
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	//$examname = $_POST['examname'];
	$question = $_POST['question'];

	$result = mysqli_query($db, "SELECT DISTINCT records.exam, records.answer, question.testcasein, question.testcaseout, question.functionName FROM question INNER JOIN records ON question.questionbody=records.question");

	while ($row = $result->fetch_assoc()) {
		//printf('{"questionbody": "%s", "difficulty":"%s", "topic":"%s"}', $row['questionbody'], $row['difficulty'], $row['topic']);
		array_push($arr, $row);	
	}

	$json = json_encode($arr);
	echo $json;

	$db->close();
?>
