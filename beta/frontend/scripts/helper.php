<?php
session_start();

function check_session($user_type) {

    if (is_logged_in() == false || $user_type != $_SESSION['user_type']) {
        header('Status: 404 Not Found', false, 404); 
        header('Location: ../404.php'); 
    }
}


// set session variables
function session_login($username, $user_type) {
    // console_log("hello");
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

function console_log($data){
    echo '<script>';
    echo 'console.log('.json_encode($data).')';
    echo '</script>';
}


?>