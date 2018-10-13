<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 10/12/18
 * Time: 10:36 PM
 */

function jsonifyArray($array, &$data){
    foreach ($array as $key => $value) {
        if ($data == ""){
            $data .= "{ \"$key\":\"$value\"";
        }
        else {
            $data .= ", \"$key\":\"$value\"";
        }
    }
    $data .= " }";
}

$questionId = uniqid("", TRUE);
$questionBody = "Write a function named 'double' that doubles an integer input";
$testCasesArray = array(1=>1, 2=>4, 3=>9);
$testCases = "";
jsonifyArray($testCasesArray,$testCases);
var_dump($testCases);
echo '<br>';

$dataArray = array(
    'questionId'=>$questionId,
    'questionBody'=>$questionBody,
    'testCases'=>$testCases
);
$data = "";
jsonifyArray($dataArray,$data);
var_dump($data);
echo '<br>';

function sendQuestion($data){

    #$url = "https://web.njit.edu/~eo65/CS490_project/cs490_alpha/backend/login.php";
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
//    if (strpos($response, 'Welcome') == true){
//        $JSON['db'] = "success";
//    } else {
//        $JSON['db'] = "fail";
//    }
    curl_close($ch);
}

sendQuestion($data);