<?php

    include "db.php";

    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }


    $sql = "SELECT DISTINCT exam, question, points FROM examquestionlist";
    //	echo '{"Success":"Submittion successfull"}';
    $result = $db->query($sql);
		//if ($result->num_rows > 0) {
    echo "<table><tr><th>exam</th><th>question</th><th>points</th></tr>";
    	// output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["exam"]. "</td><td>" . $row["question"]. "</td><td>" . $row["points"] . "</td></tr>";
    }
    echo "</table>";

?>