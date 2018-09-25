<?php
// $uname = $_POST['username'];
// $pword = $_POST['password'];
// $response = "username is $uname and password is $pword";
// echo $response;

if (isset($_POST['username']) && isset($_POST['password'])  ) {
    $uname = $_POST['username'];
    $pword = $_POST['password'];
    $response = send_to_midend($uname, $pword);
    echo $response;
}

function send_to_midend($username, $password) {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490_alpha/midend/index.php';
    $ch = curl_init();

    $auth_fields = array(
        'username' => $username,
        'password' => $password
    ); 
    
    $opt_array = array(
        CURLOPT_URL => $URL,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS =>  $auth_fields,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => true,
        CURLOPT_FOLLOWLOCATION => true,
    );

    curl_setopt_array($ch, $opt_array);
    curl_exec($ch); 
    
   
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

?>