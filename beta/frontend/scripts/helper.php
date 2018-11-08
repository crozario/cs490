<?php
session_start();

function check_session($user_type) {
    if (is_logged_in() === false) {
        header('Status: 404 Not Found', false, 404); 
        header('Location: ../404.php'); 
    }
}


// set session variables
function session_login($username, $user_type) {
    $_SESSION['username'] = $username;
    $_SESSION['user_type'] = $user_type;
}

// delete session variables
function session_logout() {
    $_SESSION = array();
    session_destroy();
}

function get_username() {
    return $_SESSION['username'];
}

function is_logged_in() {
    if (isset($_SESSION['username']) && isset($_SESSION['user_type'])  ) {
        return true;
    } 
    return false;
}

function is_logged_out() {
    if (isset($_SESSION['username']) && isset($_SESSION['user_type'])  ) {
        return false;
    } 
    return true;
}

function send_login_info($username, $password) {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/login.php';
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
        CURLOPT_HEADER => false
    );

    curl_setopt_array($ch, $opt_array);
    curl_exec($ch); 
    
   
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

function console_log($data){
    echo '<script>';
    echo 'console.log('.json_encode($data).')';
    echo '</script>';
  }

?>