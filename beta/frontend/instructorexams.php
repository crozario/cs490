<?php
session_start();
include_once("scripts/helper.php");
check_session("instructor");
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

<body onload="instructor_exams_onload(); return false;">

    <div class="nav-bar-container">
        <div class="nav-bar-left">
            <a href="instructorhome.php">Home</a>
            <a class="active" href="instructorexams.php">Create Exams</a>
            <a href="questionbank.php">Question Bank</a>
        </div>
          
        <div class="nav-bar-right">
            <a class="nav-bar-user"></a>
            <button onclick="logout_button_pressed(); return false;">Logout</button>
        </div>
        
    </div>

    <div class="question-bank-filtering-instructor-exam-page">
        <div class="question-bank-filtering">
            <h2>Filtering</h2>

            <div id="topic-select-filtering-instructor-exam">
                <label for="topic-select-filtering-instructor">Topic:</label>

            </div>

            <div id="difficulty-select-filtering-instructor-exam">
                <label for="difficulty-select-filtering-instructor">Difficulty:</label>

            </div>

            <div>
                <label for="keyword-filter-name-instructor">Keyword:</label>
                <textarea name="keyword-filter-name-instructor" id="keyword-filter-name-instructor" cols="50" rows="1"></textarea>
            </div>

            <button onclick="filter_button_pressed_instructor_exam(); return false;">Filter</button>
            <button onclick="filtering_reset_button_pressed_instructor_exam(); return false;">Reset</button>
            
        </div>


        <div class="question-bank-container">
            <h2>Question Bank</h2>
            <div>
                <table id="question-bank-table-exams">
                    <tr>
                        <th>Topic</th>
                        <th>Difficulty</th>
                        <th>Question</th>
                    </tr>
                </table>
            </div>

        </div>
    </div>  
        

        <div class="add-exam-container">
            <h2>Create Exam</h2>
            <div>
                <input id="add-exam-input" type="text" placeholder="Enter Exam Name" name="exam_name" required>
            </div>
            <div>
                <table id="add-exam-table">
                    <tr>
                        <th>Topic</th>
                        <th>Difficulty</th>
                        <th>Question</th>
                        <th>Points</th>
                    </tr>

                </table>
            </div>
            <div>
                <button class="add-exam-button" type="button" onclick="add_exam_button_pressed(); return false;">Add Exam</button>
            </div>

        </div>

    </div>

</body>

</html>