<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 10/12/18
 * Time: 10:44 PM
 */

//echo file_get_contents('php://input');

//$questionId = uniqid("", TRUE); //$_POST['questionId'];
$questionBody = "Write a function named double that doubles an integer input"; //$_POST['questionBody'];
$testcasein = "1:2:3"; //$_POST['testCasesIn'];
$testcaseout = "2:4:6"; //$_POST['testCasesOut'];
$difficulty = 'easy'; //$_POST['difficulty'];
$functionName = 'double';//$_POST['partans'];
$topic = 'function';

$data = array(
    'questionBody'=>$questionBody,
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
    var_dump($data);
    echo '<br>';

    $response = curl_exec($ch) or die("Curl to backend_add_question didn't work");
    //maybe backend should print a success or fail for adding question
    print_r($response );
//    if (strpos($response, 'Welcome') == true){
//        $JSON['db'] = "success";
//    } else {
//        $JSON['db'] = "fail";
//    }
    curl_close($ch);
}
