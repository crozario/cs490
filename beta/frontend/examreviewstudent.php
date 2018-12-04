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
    <title>Instructor Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/style.css" />
    <script src="scripts/main.js"></script>

</head>

<body onload="exam_review_student_onload(); return false;">
    

    <div class="nav-bar-container">
        <div class="nav-bar-left">
            <a class="active" href="studenthome.php">Home</a>
        </div>
          
        <div class="nav-bar-right">
            <a class="nav-bar-user"></a>
            <button onclick="logout_button_pressed(); return false;">Logout</button>
        </div>  
    </div>

    <div class="exam-review-student-page">
        <h2 id="exam-review-student-exam-name"></h2>

        <div id="exam-review-student-info-container">
        
        </div>

        <div id="exam-review-student-container">
        
        </div>
    
    </div>

    <div class="done-review-exam">
        <button onclick="student_review_done_button_pressed(); return false;">Done</button>
    </div>
</body>

</html>