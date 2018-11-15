<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 10/13/18
 * Time: 12:21 AM
 */

//read in the changed grades and CURL to back

function sendQuestion($data){

    #$url = "https://web.njit.edu/~eo65/CS490_project/cs490_alpha/backend/login.php";
    $url = "backendchangegrades";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    var_dump($data);
    echo '<br>';

    $response = curl_exec($ch) or die("Curl to backendchangegrades didn't work");
    print_r($response );
//    if (strpos($response, 'Welcome') == true){
//        $JSON['db'] = "success";
//    } else {
//        $JSON['db'] = "fail";
//    }
    curl_close($ch);
}
