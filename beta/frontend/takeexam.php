<?php
session_start();
include_once("scripts/helper.php");
check_session("student");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Take Exam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/style.css" />
    <script src="scripts/main.js"></script>

</head>

<body onload="take_exam_onload(); return false;">

    <div class="nav-bar-container">
        <div class="nav-bar-left">
            <a class="active" href="studenthome.php">Home</a>
        </div>
          
        <div class="nav-bar-right">
            <a class="nav-bar-user"></a>
            <button onclick="logout_button_pressed(); return false;">Logout</button>
        </div>  
    </div>

    <div id="exam-container">
        <h2 id="take-exam-name"></h2>

        <div id="take-exam-container">
        
        </div>
    </div>
    <div class="submit-exam">
        <button onclick="take_exam_submit_button_pressed(); return false;">Submit</button>
    </div>
</body>

</html>