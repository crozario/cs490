<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 10/15/18
 * Time: 10:09 PM
 */

//$questionId = uniqid("", TRUE);
//"def double(num):
//    print(num*2)"
//"def multiply(num1, num2):
//    print(num1*num2)"

$answer = "def multiply(num1, num2):
    print(num1*num2)";
$testCasesIn = "1,2:2,3:3,4";
$testCasesOut = "2:6:12";
$functionName = "multiply";

$data = array(
    'answer'=>$answer,
    'testCasesIn'=>$testCasesIn,
    'testCasesOut'=>$testCasesOut,
    'functionName'=>$functionName
);

//var_dump($data);
//echo '<br>';

sendQuestion($data);

function sendQuestion($data){

    $url = "https://web.njit.edu/~ak697/cs490/cs490-beta/gradetest.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    var_dump($data);
//    echo '<br>';
    //die is also called if the response is empty
    $response = curl_exec($ch) or die("Curl to submitAnswer didn't work");
    print_r($response );
//    if (strpos($response, 'Welcome') == true){
//        $JSON['db'] = "success";
//    } else {
//        $JSON['db'] = "fail";
//    }
    curl_close($ch);
}
