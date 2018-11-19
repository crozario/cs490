<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 10/12/18
 * Time: 10:44 PM
 */

//adding a question to backend table

//$questionId = uniqid("", TRUE); //$_POST['questionId'];
$questionBody = $_POST['question'];
$testcasein = $_POST['test_case_in'];
$testcaseout = $_POST['test_case_out'];
$difficulty = $_POST['difficulty'];
$functionName = $_POST['function_name'];
$topic = $_POST['topic'];
$constraint = $_POST['constraint'];
 
var_dump($_POST);
//echo $questionBody .' '. $testcasein .' '. $testcaseout .' '. $difficulty .' '. $functionName .' '. $topic;
$data = array(
    'questionbody'=>addslashes($questionBody),
    'difficulty'=>$difficulty,
    'topic'=>$topic,
    'testcasein'=>addslashes($testcasein),
    'testcaseout'=>addslashes($testcaseout),
    'functionName'=>$functionName,
    'constraint'=>$constraint
);

sendQuestion($data);

function sendQuestion($data){
    $url = "https://web.njit.edu/~eo65/cs490/beta/backend/addquestion.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    var_dump($data);
//    echo '<br>';
    $response = curl_exec($ch) or die("Curl to backend_add_question didn't work");
    //maybe backend should print a success or fail for adding question
    print_r($response);
    if (strpos($response, 'Nice') == true){
        echo '{"added":true}';
    } else {
        echo '{"added":false}';
    }
    curl_close($ch);
}
