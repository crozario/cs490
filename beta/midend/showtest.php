<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 11/7/18
 * Time: 9:49 PM
 */
//shows all created exams to instructor on homepage
showTest();
function showTest(){
    $url = "https://web.njit.edu/~eo65/cs490/beta/backend/examlist.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    var_dump($data);
//    echo '<br>';
    $response = curl_exec($ch) or die("Curl to backend_add_test didn't work");
    //backend should probably print success or fail for adding test
    print_r($response );
    curl_close($ch);
}