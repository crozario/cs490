

<?php

if (isset($_POST['username']) && isset($_POST['password'])  ) {
    $uname = $_POST['username'];
    $pword = $_POST['password'];
    // make_cookie($uname);
    $response = send_login_info($uname, $pword);
    echo $response;

} elseif (isset($_POST['add_question'])) {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/addquestion.php';
    $ch = curl_init();

    $auth_fields = array(
        'question' => $_POST['question'],
        'function_name' =>$_POST['function_name'],
        'topic' =>$_POST['topic'],
        'difficulty' =>$_POST['difficulty'],
        'test_case_in' =>$_POST['test_case_in'],
        'test_case_out' =>$_POST['test_case_out']
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

    echo $response;

} elseif (isset($_POST['get_question_bank'])) {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/showquestionstofront.php';
    $ch = curl_init();

    $auth_fields = array(
        'get_question_bank' => $_POST['get_question_bank'],
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

    echo $response;
} elseif (isset($_POST['send_exam'])) {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/addtest.php';
    $ch = curl_init();

    $auth_fields = array(
        'exam_name' => $_POST['exam_name'],
        'questions' => $_POST['questions'],
        'points' => $_POST['points']
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

    echo $response;
} elseif (isset($_POST['take_exam_student'])) {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/showexamtostudent.php';
    $ch = curl_init();

    $auth_fields = array(
        'take_exam_student' => $_POST['take_exam_student'],
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

    echo $response;
} elseif (isset($_POST['take_exam_submit'])) {

    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/testSubmitAnswer.php';
    $ch = curl_init();

    $auth_fields = array(
        'user_name' => $_POST['user_name'],
        'answers' => $_POST['answers'],
        'exam_name' => $_POST['exam_name']
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

    echo $response;

} elseif (isset($_POST['get_user_name'])) {
    // echo  $_SESSION["user_name"];
    // echo $_COOKIE['user'];
} elseif (isset($_POST['logout'])) {
    // destroy_cookie();

} elseif (isset($_POST['get_student_exam_list'])) {
    // https://web.njit.edu/~ak697/cs490/cs490-beta/showreleasedexamtostudent.php
} elseif (isset($_POST['get_pending_exams'])) {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/showtest.php';
    $ch = curl_init();

    $auth_fields = array(
        'get_pending_exams' => $_POST['get_pending_exams'],
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

    echo $response;
} 

// if (isset($_POST['username']) && isset($_POST['password'])  ) {
//     $uname = $_POST['username'];
//     $pword = $_POST['password'];
//     $response = send_login_info($uname, $pword);
//     echo $response;
// }


function destroy_cookie() {
    setcookie("user", "", time() - 3600);
}

function make_cookie($username) {
    ob_start();
    $cookie_name = "user";
    $cookie_value = $username;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    ob_end_flush();
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

?>
