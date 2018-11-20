<?php
var_dump($_POST);

$comments = $_POST['comments'];
$points = $_POST['points'];
$questions = $_POST['questions'];
process($comments);
process($questions);
process($points);

for ($x=0; $x<count($comments);$x++){
    echo "post: ". $x.'<br>';
    $data = array(
        'user' => $_POST['user'],
        'exam' => $_POST['exam'],
        'points' => $points[$x],
        'comments' => $comments[$x],
        'question'=> $questions[$x]
    );
    //var_dump($data);
    update($data);
}

//var_dump($_POST);
function process(&$str){
    $str = trim($str,"\"[]");
    $str = explode("\",\"", $str);
}

function update($data){
    $url = "https://web.njit.edu/~eo65/cs490/beta/backend/updategrade.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    var_dump($data);
//    echo '<br>';

    $info = curl_exec($ch) or die("Curl to backend_get_questions didn't work");
    //print_r($info);
    curl_close($ch);
}