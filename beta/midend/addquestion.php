<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 10/12/18
 * Time: 10:44 PM
 */

//echo file_get_contents('php://input');

//$questionId = uniqid("", TRUE); //$_POST['questionId'];
$questionBody = $_POST['question']; //"Write a function named double that doubles an integer input"; //
$testcasein = $_POST['test_case_in']; //"1:2:3";
$testcaseout = $_POST['test_case_out']; //"2:4:6";
$difficulty = $_POST['difficulty']; //'easy';
$functionName = $_POST['function_name']; //'double';
$topic = $_POST['topic']; //'function';

$data = array(
    'questionbody'=>$questionBody,
    'difficulty'=>$difficulty,
    'topic'=>$topic,
    'testcasein'=>$testcasein,
    'testcaseout'=>$testcaseout,
    'functionName'=>$functionName
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
//    print_r($response);
    if (strpos($response, 'Nice') == true){
        echo '{"added":true}';
    } else {
        echo '{"added":false}';
    }
    curl_close($ch);
}
