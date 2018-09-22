<?php

function auth_njit($user, $pass){
$data = array(
    'ucid' => $user,
    'pass' => $pass
);
#https://aevitepr2.njit.edu/myhousing/login.cfm

$url = "https://web.njit.edu/~eo65/CS490_project/cs490_alpha/backend/login.php";
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);
print_r($response);
// if (strpos($response, 'Please select a MyHousing System to sign into:') == true){
//   echo json_encode("Successful Login");
// } else {
// 	echo json_encode("Failed Login");
// }
// curl_close($ch);
}

function auth_db($user, $pass){
$data = array(
    'username' => $user,
    'password' => $pass
);
#https://aevitepr2.njit.edu/myhousing/login.cfm

$url = "https://web.njit.edu/~eo65/CS490_project/cs490_alpha/backend/login.php";
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);
print_r($response);
// if (strpos($response, 'Please select a MyHousing System to sign into:') == true){
//   echo json_encode("Successful Login");
// } else {
// 	echo json_encode("Failed Login");
// }
// curl_close($ch);
}

#TODO: add backend php page URL

#TODO: add if-else logic for login response from backend

$USER = 'user';//$_POST['username'];
$PASS = '123456';//$_POST['password'];

auth_njit($USER, $PASS);
auth_db($USER, $PASS);

#TODO: send JSON data to the frontend php URL
?>
