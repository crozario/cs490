<?php

include "db.php";
	
if ($db->connect_error) {
	die('Connection failed: ' . $db->connect_error);
}

$sql1 = "TRUNCATE TABLE examquestionlist";
$sql2 = "TRUNCATE TABLE records";
$sql3 = "TRUNCATE TABLE taken";

$db->query($sql1);
$db->query($sql2);
$db->query($sql3);
?>