<?php

    include "db.php";

    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }


    $sql = "SELECT DISTINCT * FROM question";
    //	echo '{"Success":"Submittion successfull"}';
    $result = $db->query($sql);
		//if ($result->num_rows > 0) {
    echo "<table><tr><th>num</th><th>question</th><th>difficult</th><th>topic</th><th>testcasesin</th><th>testcasesout</th><th>functionName</th><th>constraints</th></tr>";
    	// output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["num"]. "</td><td>" . $row["questionbody"]. "</td><td>" . $row["difficulty"]. "</td><td>" . $row["topic"]. "</td><td>" . $row["testcasein"]. "</td><td>" . $row["testcaseout"]. "</td><td>" . $row["functionName"]. "</td><td>" . $row["constraints"] . "</td></tr>";
    }
    echo "</table>";

?>