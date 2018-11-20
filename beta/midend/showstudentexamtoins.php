<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 11/17/18
 * Time: 1:31 PM
 */


$data = array(
    'user'=> 'ez90',//$_POST['user'],
    'exam' => 'exam1'//$_POST['exam']
);

sendAnswers($data);

function sendAnswers($data){
    $url = "https://web.njit.edu/~eo65/cs490/beta/backend/showstudentexamtoins.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    echo '<br>';
    //die is also called if the response is empty
    $response = curl_exec($ch) or die("Curl to $url didn't work");
//    var_dump($data);
    print_r($response );
    curl_close($ch);
}
