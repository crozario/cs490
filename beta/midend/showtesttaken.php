<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 11/4/18
 * Time: 3:21 PM
 */

#show taken examname

showTest();
function showTest(){
    $url = "https://web.njit.edu/~eo65/cs490/beta/backend/showtesttakenlist.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    var_dump($data);
//    echo '<br>';
    $response = curl_exec($ch) or die("Curl to backend_add_test didn't work");
    //backend should probably print success or fail for adding test
    print_r($response );
//    if (strpos($response, 'Welcome') == true){
//        $JSON['db'] = "success";
//    } else {
//        $JSON['db'] = "fail";
//    }
    curl_close($ch);
}