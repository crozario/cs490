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
    <title>Student Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/style.css" />
    <script src="scripts/main.js"></script>

</head>

<body onload="student_home_onload(); return false;">
    <div class="nav-bar-container">
        <div class="nav-bar-left">
            <a class="active" href="studenthome.php">Home</a>
        </div>
          
        <div class="nav-bar-right">
            <a class="nav-bar-user"></a>
            <button onclick="logout_button_pressed(); return false;">Logout</button>
        </div>
        
    </div>

    <div class="list-table">
        <table id="pending-exams-student">
            <tr>
                <th>Exam Name</th>
                <!-- <th>Grade</th> -->
                <th>Status</th>  <!-- Take Button(exam not taken), Pending(exam taken), See Grade Button(Released)  -->
            </tr>
        </table>
    </div>
</body>

</html>

