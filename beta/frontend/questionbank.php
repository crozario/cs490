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
    <title>Question Bank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/style.css" />
    <script src="scripts/main.js"></script>

</head>

<body onload="question_bank_onload(); return false;">
    <div class="nav-bar-container">
        <div class="nav-bar-left">
            <a href="instructorhome.php">Home</a>
            <a href="instructorexams.php">Create Exams</a>
            <a class="active"  href="questionbank.php">Question Bank</a>
        </div>
          
        <div class="nav-bar-right">
            <a class="nav-bar-user"></a>
            <button onclick="logout_button_pressed(); return false;">Logout</button>
        </div>
        
    </div>

    <div class="question-bank-page">
        <div class="question-bank-filtering">
            <h2>Filtering</h2>

            <div id="topic-select-filtering-question-bank">
                <label for="topic-select-filtering">Topic:</label>

            </div>

            <div id="difficulty-select-filtering-question-bank">
                <label for="difficulty-select-filtering">Difficulty:</label>

            </div>

            <div>
                <label for="keyword-filter-name">Keyword:</label>
                <textarea name="keyword-filter-name" id="keyword-filter-name" cols="50" rows="1"></textarea>
            </div>

            <button onclick="filter_button_pressed_question_bank(); return false;">Filter</button>
            <button onclick="filtering_reset_button_pressed_question_bank(); return false;">Reset</button>
            
        </div>

        <div class="question-bank-container">
            <h2>Question Bank</h2>
            <div>
                <table id="question-bank-table">
                    <tr>
                        <th>Topic</th>
                        <th>Difficulty</th>
                        <th>Question</th>
                    </tr>

                </table>
            </div>

        </div>

        <div class="create-question-container">
            <h2>Create Question</h2>
            <form id="create-question-form">
                <div class="question-label-textarea">
                    <label for="question">Question: </label>
                    <textarea name="question" id="question" cols="50" rows="5"></textarea>
                </div>


                <div>
                    <label for="function-name">Function Name:</label>
                    <input type="text" id="function-name" />
                </div>

                <div id="topic-select-question-bank">
                    <label for="topic-select">Topic:</label>

                </div>

                <div id="difficulty-select-question-bank">
                    <label for="difficulty-select">Difficulty:</label>

                </div>

                <div id="constraint-select-question-bank">
                    <label for="constraint-select">Constraint:</label>

                </div>

                <div>
                    <label for="test-cases-table">Test Cases:</label>
                    <table id="test-cases-table">
                        <tr>
                            <th>Input</th>
                            <th>Output</th>  
                            <th> <button onclick="add_test_case_button(); return false;">Add</button> </th> 
                        </tr>
                        <tr>
                            <td> <input type="text">  </td>
                            <td> <input type="text">  </td>                                
                        </tr>
                    </table>
                </div>
                <div>
                    <button onclick="add_question_button_pressed(); return false;">Add Question</button>
                </div>

            </form>

        </div>
    </div>

</body>

</html>