
<?php
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	//$examname = $_POST['examname'];
	$question = $_POST['question'];

	$result = mysqli_query($db, "SELECT DISTINCT examquestionlist.exam, question.testcasein, question.testcaseout, question.functionName, examquestionlist.graded FROM question INNER JOIN examquestionlist ON question.questionbody=examquestionlist.question WHERE question = '$question' && graded = 0");

	if (mysqli_num_rows($result) > 1) {
       	$row = $result->fetch_assoc();
       	printf('{"testcasein":"%s","testcaseout":"%s","functionName":"%s"}', $row['testcasein'], $row['testcaseout'], $row['functionName']);

       	mysqli_query($db, "UPDATE examquestionlist SET graded = 1 WHERE exam ='$examname' && question = '$question'");
	}
	else {
		echo '{"error":"error"}';
	}

	$db->close();
?>
