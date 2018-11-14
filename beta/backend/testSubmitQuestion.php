

<?php

	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['user'];
	$examid = $_POST['exam'];
	$answer = $_POST['answer'];	


	$arr = array();
	$sql = "INSERT INTO records (user, exam, answer) VALUES ('$user', '$examid', '$answer')";
		
	if ($db->query($sql) === TRUE) {
    //	echo '{"Success":"Submittion successfull"}';

    	$sql = "SELECT DISTINCT * FROM records";
		$result = $db->query($sql);

		
		//if ($result->num_rows > 0) {
    		echo "<table><tr><th>user</th><th>points</th><th>exam</th><th>testcasesin</th><th>testcasesout</th><th>expectedtestcaseout</th><th>question</th><th>answer</th><th>autograde</th><th>updategrade</th><th>comment</th><th>release</th></tr>";
    	// output data of each row
    		while($row = $result->fetch_assoc()) {
    			array_push($arr, $row);
        		echo "<tr><td>" . $row["user"]. "</td><td>" . $row["points"]. "</td><td>" . $row["exam"]. "</td><td>" . $row["testcasesin"]. "</td><td>" . $row["testcasesout"]. "</td><td>" . $row["expectedtestcaseout"]. "</td><td>" . $row["question"]. "</td><td>" . $row["answer"]. $row["autograde"]. "</td><td>" .  $row["updategrade"]. "</td><td>" . $row["comment"] . "</td><td>" . $row["rel"] ."</td></tr>";
    		}
    		echo "</table>";
    		$json = json_encode($arr);
			//echo $json;
    //	} 
	} else {
   		printf('{"Error adding":"%s"}', $db->error);
	}

	$sql1 = "SELECT DISTINCT points, question, answer FROM records WHERE exam = '$examid' AND user = '$user' AND points = 'NULL'";

	if ($result = mysqli_query($db, $sql1)) {
		$row_cnt1 = mysqli_num_rows($result);
	}

	$sql2 = "SELECT DISTINCT exam, question FROM examquestionlist WHERE exam = '$examid'";

	if ($result1 = mysqli_query($db, $sql2)) {
		$row_cnt2 = mysqli_num_rows($result1);
	}

	if ($row_cnt1 == $row_cnt2) {
		$sql3 = "UPDATE taken SET taken = 1 WHERE user = '$user'";
		$db->query($sql3);
	}
?>

