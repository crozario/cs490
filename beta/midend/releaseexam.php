<?php

showGrades($data);
function showGrades($data){

    $url = "https://web.njit.edu/~eo65/cs490/beta/backend/releaseexam.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    var_dump($data);
//    echo '<br>';

    $response = curl_exec($ch) or die("Curl to backend_get_questions didn't work");
    print_r($response );
    curl_close($ch);
}