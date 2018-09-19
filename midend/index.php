<?php

$data = array(
    'user' => 'user',
    'pass' => 'password',
	'uuid' => '0xACA021'
);

$url = "https://cp4.njit.edu/cp/home/login";
$ch = curl_init($url);

$postString = http_build_query($data, '', '&');

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
if (strpos($response, 'ERROR') === false){
	echo "Successful Login";
} else {
	echo "Failed Login";
}
curl_close($ch);

?>
