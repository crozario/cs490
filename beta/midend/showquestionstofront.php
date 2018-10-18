<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 10/17/18
 * Time: 4:58 PM
 */

//POST to backend and print out all the questions in JSON format
showQuestions();

function showQuestions(){

    $url = "https://web.njit.edu/~eo65/cs490/beta/backend/showquestion.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    var_dump($data);
//    echo '<br>';

    $response = curl_exec($ch) or die("Curl to backend_get_questions didn't work");
    print_r($response );
//    if (strpos($response, 'Welcome') == true){
//        $JSON['db'] = "success";
//    } else {
//        $JSON['db'] = "fail";
//    }
    curl_close($ch);
}