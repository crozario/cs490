<?php
session_start();
include_once("helper.php");


// $mid_endpoints = array(
//     'login' => 'https://web.njit.edu/~ak697/cs490/cs490-beta/login.php',
//     'add_question' => 'https://web.njit.edu/~ak697/cs490/cs490-beta/addquestion.php',
//     'get_question_bank' => 'https://web.njit.edu/~ak697/cs490/cs490-beta/showquestionstofront.php',
//     'send_exam' => 'https://web.njit.edu/~ak697/cs490/cs490-beta/addtest.php',
//     'take_exam_student' => 'https://web.njit.edu/~ak697/cs490/cs490-beta/showexamtostudent.php',
//     'take_exam_submit' => 'https://web.njit.edu/~ak697/cs490/cs490-beta/testSubmitAnswer.php',
//     'get_pending_exams' => 'https://web.njit.edu/~ak697/cs490/cs490-beta/showtest.php'

// );

if (isset($_POST['login'])) {
    $response = login();
    $json_array = json_decode($response, true);
    $username = $_POST['username'];
    $user_type = $json_array['login'];
    if ($user_type != 'fail') {
        session_login($username, $user_type);  
    }
    echo $response;
} elseif (isset($_POST['add_question'])) {
    $response = add_question();
    echo $response;
} elseif (isset($_POST['get_question_bank'])) {
    $response = get_question_bank();
    echo $response;
} elseif (isset($_POST['send_exam'])) {
    $response = send_exam();
    echo $response;
} elseif (isset($_POST['take_exam_student'])) {
    $response = take_exam_student();
    echo $response;
} elseif (isset($_POST['take_exam_submit'])) {
    $response = take_exam_submit();
    echo $response;
} elseif (isset($_POST['get_username'])) {
    $response = get_username();
    echo $response;
} elseif (isset($_POST['logout'])) {
    session_logout();
} elseif (isset($_POST['exam_review_list'])) {
    $response = exam_review_list();
    echo $response;
} elseif (isset($_POST['student_exams'])) {
    $response = student_exams();
    echo $response; 
} elseif (isset($_POST['save_take_exam'])) {
    $response = save_take_exam();
    echo $response;
} elseif (isset($_POST['get_exam_and_student'])) {
    $response = get_exam_and_student();
    echo $response;
} elseif (isset($_POST['get_pending_exams'])) {
    $response = get_pending_exams();
    echo $response;
} elseif (isset($_POST['exam_review_student'])) {
    $response = exam_review_student();
    echo $response;
} elseif (isset($_POST['save_check_grade_exam'])) {
    $response = save_check_grade_exam();
    echo $response;
} elseif (isset($_POST['check_grade_exam_and_student'])) {
    $response = check_grade_exam_and_student();
    echo $response;
} elseif (isset($_POST['save_exam_review_list'])) {
    $response = save_exam_review_list();
    echo $response;
} elseif (isset($_POST['get_exam_review_list'])) {
    $response = get_exam_review_list();
    echo $response;
} elseif (isset($_POST['exam_review_instructor'])) {
    $response = exam_review_instructor();
    echo $response;
} elseif (isset($_POST['release_exam'])) {
    $response = release_exam();
    echo $response;
} 

function exam_review_student() {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/showgradetostudent.php';  
    $ch = curl_init();


    $auth_fields = array(
        'user' => $_POST['user'],
        'exam' => $_POST['exam'],
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

function release_exam() {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/updategrade.php';  
    $ch = curl_init();


    $auth_fields = array(
        'user' => $_POST['username'],
        'exam' => $_POST['examname'],
        'points' => $_POST['new_points'],
        'comments' => $_POST['comments']
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
    
    $arr = $_POST['new_points'];
   
    $response = curl_exec($ch);
    curl_close($ch);
    return $response; 
    // return $arr;
}

function save_take_exam() {
    $_SESSION['save_take_exam'] = $_POST['save_take_exam'];
    return $_SESSION['save_take_exam'];
}

function save_check_grade_exam() {
    $_SESSION['save_check_grade_exam'] = $_POST['save_check_grade_exam'];
    return $_SESSION['save_check_grade_exam'];
}


function save_exam_review_list() {
    $_SESSION['student_user'] = $_POST['student_user'];
    $_SESSION['student_exam'] = $_POST['student_exam'];
    return "{$_SESSION['student_user']} : {$_SESSION['student_exam']}";

}

function get_exam_and_student() {
    $json_array = array(
        'exam' => $_SESSION['save_take_exam'],
        'student' => get_username()
    );

    return json_encode($json_array);
}

function check_grade_exam_and_student() {
    $json_array = array(
        'exam' => $_SESSION['save_check_grade_exam'],
        'student' => get_username()
    );

    return json_encode($json_array);
}

function get_exam_review_list() {
    $json_array = array(
        'student_user' => $_SESSION['student_user'],
        'student_exam' => $_SESSION['student_exam']
    );

    return json_encode($json_array);
}

// function exam_review_student() {
//     $URL = 'https://web.njit.edu/~eo65/cs490/beta/backend/showstudentexamtoins.php';  
//     $ch = curl_init();


//     $auth_fields = array(
//         'username' => $_POST['username'],
//         'password' => $_POST['password']
//     ); 
    
//     $opt_array = array(
//         CURLOPT_URL => $URL,
//         CURLOPT_POST => true,
//         CURLOPT_POSTFIELDS =>  $auth_fields,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_HEADER => false
//     );

//     curl_setopt_array($ch, $opt_array);
//     curl_exec($ch); 
    
   
//     $response = curl_exec($ch);
//     curl_close($ch);
//     $response = "hello";
//     return $response; 
// }
function exam_review_instructor() {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/showstudentexamtoins.php';
    $ch = curl_init();


    $auth_fields = array(
        'user' => $_POST['user'],
        'exam' => $_POST['exam']
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

function login() {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/login.php';  
    $ch = curl_init();


    $auth_fields = array(
        'username' => $_POST['username'],
        'password' => $_POST['password']
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

function add_question() {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/addquestion.php';
    $ch = curl_init();

    $auth_fields = array(
        'question' => $_POST['question'],
        'function_name' =>$_POST['function_name'],
        'topic' =>$_POST['topic'],
        'difficulty' =>$_POST['difficulty'],
        'constraint' =>$_POST['constraint'],
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

    $response = $_POST['question'];
    return $response;
}

function get_question_bank() {
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
    return $response;
}

function send_exam() {
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
    return $response;
}

function take_exam_student() {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/showexamtostudent.php';
    $ch = curl_init();

    $auth_fields = array( 
        'take_exam_student' => $_POST['take_exam_student'],
        'exam' => $_POST['exam']
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

function take_exam_submit() {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/testSubmitAnswer.php';
    
    $res = NULL;
    $ans = json_decode($_POST['answers']);


    for ($x=0; $x<count($ans); $x++){
        $data = array(
            'user_name' => $_POST['user_name'],
            'exam_name' => $_POST['exam_name'],
            "answer"=> rawurlencode($ans[$x])
        );
        $res = sendAnswers($data, $URL);
    }

    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/gradetest.php';
    $ch = curl_init();
    $auth_fields = array(
        'user_name' => $_POST['user_name'],
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

    // return $res;
    // return urldecode($ans[0]);
    return $res;
}

function sendAnswers($data, $url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch) or die("Curl to submitAnswer didn't work");
    curl_close($ch);
    return $response;
}

function get_pending_exams() {
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
    
    return $response;
}

function exam_review_list() {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/showtesttaken.php';
    $ch = curl_init();

    $auth_fields = array(
        'exam_review_list' => $_POST['exam_review_list'],
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

function student_exams() {
    $URL = 'https://web.njit.edu/~ak697/cs490/cs490-beta/showtesttaken.php';
    $ch = curl_init();

    $auth_fields = array(
        'student_exams' => $_POST['student_exams'],
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
