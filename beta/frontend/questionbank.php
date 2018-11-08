<?php
    include_once("scripts/helper.php");
    session_start();
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
                <ul class="nav-bar">
                    <li><a href="instructorhome.php">Home</a></li>
                    <li><a href="instructorexams.php">Create Exams</a></li>
                    <li><a href="questionbank.php">Question Bank</a></li>
                </ul>
                <button onclick="logout_button_pressed(); return false;">Logout</button>
        
            </div>

    <div class="question-bank-page">
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

                <!-- <div>
                    <label for="function-parameters">Function Parameters:</label>
                    <input type="text" id="function-parameters" />
                </div> -->


                <div>
                    <label for="topic-select">Topic:</label>
                    <select id="topic-select">
                        <option value="conditionals">Conditionals</option>
                        <option value="recursion">Recursion</option>
                        <option value="loops">Loops</option>
                        <option value="strings">Strings</option>
                    </select>
                </div>

                <div>
                    <label for="difficulty-select">Difficulty:</label>
                    <select id="difficulty-select">
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
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