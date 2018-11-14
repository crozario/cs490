<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 10/12/18
 * Time: 10:36 PM
 */

#for testing my addquestion page adding questions to table

//$questionId = uniqid("", TRUE);
$questionBody = "Write a function named 'doubleIt' that doubles an integer input";

$data = array(
    'question'=>addslashes($questionBody),
    'test_case_in'=>"1:2:3",
    'test_case_out'=>"2:4:6",
    'difficulty'=>'easy',
    'function_name'=>'double',
    'topic'=>'function'
);

//$data = "";
//jsonifyArray($dataArray,$data);
//var_dump($data);
//echo '<br>';

sendQuestion($data);

function sendQuestion($data){

    $url = "https://web.njit.edu/~ak697/cs490/cs490-beta/addquestion.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    var_dump($data);
    echo '<br>';
    //die is also called if the response is empty
    $response = curl_exec($ch) or die("Curl to submitQuestion didn't work");
    print_r($response );
    curl_close($ch);
}