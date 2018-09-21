<?php
	
	include "db.php";

	if ($db->connect_error) {
 		die('Connection failed: ' . $db->connect_error);
	}

	$user = $_POST['username'];
	$pass = sha1($_POST['password']);


	if (isset($user) && isset($pass)) {
		$result = mysqli_query($db, "SELECT * FROM Login WHERE user = '$user' && password = '$pass'");
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
        		echo "Welcome to the web";
    		}	
		}
		else {
			echo "Wrong username or password";
		}
	}
	else {
		echo 'There is no input';
	}
	
?>

