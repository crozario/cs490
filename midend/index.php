<?php
$JSON = array();
function auth_njit($user, $pass, &$JSON){
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
// print_r($response);

if (strpos($response, 'Please select a MyHousing System') == true){
  $JSON['njit'] = "success";
} else {
  $JSON['njit'] = "fail";
}
curl_close($ch);
}

function auth_db($user, $pass, &$JSON){
$data = array(
    'username' => $user,
    'password' => $pass
);

$url = "https://web.njit.edu/~eo65/CS490_project/cs490_alpha/backend/login.php";
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
// print_r($response );

if (strpos($response, 'Welcome') == true){
  $JSON['db'] = "success";
} else {
  $JSON['db'] = "fail";
}
curl_close($ch);
}

$USER = $_POST['username'];
$PASS = $_POST['password'];

auth_njit($USER, $PASS);
//echo '<br/>';
auth_db($USER, $PASS);
print_r($JSON);


#TODO: manually parse JSON data
?>
