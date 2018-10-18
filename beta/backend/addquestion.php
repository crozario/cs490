<?php
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	
	$questionbody = $_POST['questionbody'];
	$difficulty = $_POST['difficulty'];
	$topic = $_POST['topic'];
	$testcasein = $_POST['testcasein'];
	$testcaseout = $_POST['testcaseout'];
	$functionName = $_POST['functionName'];

	if (isset($questionbody) && isset($difficulty) && isset($topic) && isset($testcasein) && isset($testcaseout) && isset($functionName)) {	
		$sql = "INSERT INTO question (questionbody, difficulty, topic, testcasein, testcaseout, functionName) VALUES ('$questionbody', '$difficulty', '$topic', '$testcasein', '$testcaseout', '$functionName')";	
		if ($db->query($sql) === True) {
    		echo '{"Success":"Nice"}';
		} else {
			printf('{"Error":"%s"}', mysqli_error($db));
		}
	}
	else {
		echo "none added";
	}
	
	$db->close();

?>

