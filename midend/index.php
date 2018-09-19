<?php
function auth_njit($user, $pass){
$data = array(
    'ucid' => $user,
    'pass' => $pass
);

$url = "https://aevitepr2.njit.edu/myhousing/login.cfm";
$ch = curl_init($url);

$postString = http_build_query($data, '', '&');

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);
if (strpos($response, 'Please select a MyHousing System to sign into:') == true){
	echo "Successful Login";
} else {
	echo "Failed Login";
}
curl_close($ch);
}

$USER = $_POST['user'];
$PASS = $_POST['pass'];

auth_njit($USER, $PASS);
?>
