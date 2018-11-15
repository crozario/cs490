<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 11/4/18
 * Time: 2:46 PM
 */
#show released exam questions to the student
$data = array(
    'exam'=>'exam1'//$_POST['exam']
);
showTest($data);
function showTest($data){
    $url = "https://web.njit.edu/~eo65/cs490/beta/backend/showquestiontostudent.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
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