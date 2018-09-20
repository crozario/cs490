<?php

function auth_njit($user, $pass){
$data = array(
    'ucid' => $user,
    'pass' => $pass
);

$url = "https://aevitepr2.njit.edu/myhousing/login.cfm";
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);
if (strpos($response, 'Please select a MyHousing System to sign into:') == true){
	header('Content-type: application/json');
  echo json_encode("Successful Login")
} else {
  header('Content-type: application/json');
	echo json_encode("Failed Login");
}
curl_close($ch);
}

// function auth($user, $pass){
// $data = array(
//     'ucid' => $user,
//     'pass' => $pass
// );
// #TODO: add backend php page URL
// $url = "";
// $ch = curl_init($url);
//
// $postString = http_build_query($data, '', '&');
//
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
// $response = curl_exec($ch);
// #TODO: add if-else logic for login response from backend
//
// curl_close($ch);
// }

$USER = $_POST['username'];
$PASS = $_POST['password'];

auth_njit($USER, $PASS);
//auth($USER, $PASS);

#TODO: send JSON data to the frontend php URL
?>
