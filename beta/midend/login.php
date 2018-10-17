<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 10/15/18
 * Time: 12:13 AM
 */

$JSON = array();
$data = "";

function auth_db($user, $pass, &$JSON){
    $data = array(
        'username' => $user,
        'password' => $pass
    );
    $url = "https://web.njit.edu/~eo65/cs490/beta/backend/login.php";
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
//    print_r($response );

    if (strpos($response, 'instructor') == true){
        $JSON['login'] = "instructor";
    } else if (strpos($response, 'student') == true){
        $JSON['login'] = "student";
    } else { $JSON['login'] = "fail"; }
    curl_close($ch);
}

function jsonify($array, &$data){
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
// jk56, alpha = instructor
$USER = $_POST['username'];
$PASS = $_POST['password'];

auth_db($USER, $PASS, $JSON);
jsonify($JSON, $data);
print_r($data);
