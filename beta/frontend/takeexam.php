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
        <ul class="nav-bar">
            <li><a href="studenthome.php">Home</a></li>
        </ul>
        <button onclick="logout_button_pressed(); return false;">Logout</button>
    </div>

    <div>
        <h2 id="take-exam-name"></h2>
    
        <table id="take-exam-table">
            <tr>

            </tr>

        </table>

    </div>
    <div>
        <button class="submit-exam" onclick="take_exam_submit_button_pressed(); return false;">Submit</button>
    </div>
</body>

</html>