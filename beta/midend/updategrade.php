<?php
$data = array(
    'user' => $_POST['user'],
    'exam' => $_POST['exam']
);
$info = "";
$url = "https://web.njit.edu/~eo65/cs490/beta/backend/showstudentanswer.php";
update($info, $data, $url);
//echo $info;
//exit();
$obj = json_decode($info);
//array to store all the exam answers
$answers = array();

foreach ($obj as $item)
{
    $answers[] = $item->answer;
    //add constraint array later
//    echo 'question: ' . $question . ' points: '.$points . '<br>';
}
//var_dump($answers);

$comments = $_POST['comments'];
$points = $_POST['points'];
process($comments);
process($points);

$url = "https://web.njit.edu/~eo65/cs490/beta/backend/updategrade.php";

for ($x=0; $x<count($comments);$x++){
    echo "post: ". $x.'<br>';
    $data = array(
        'user' => $_POST['user'],
        'exam' => $_POST['exam'],
        'points' => $points[$x],
        'comments' => $comments[$x],
        'answer'=> $answers[$x]
    );
    update($info, $data, $url);
    var_dump($data);
}

//var_dump($_POST);

function process(&$str){
    $str = trim($str,"\"[]");
    $str = explode("\",\"", $str);
}

function update(&$info, $data, $url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    var_dump($data);
//    echo '<br>';

    $info = curl_exec($ch) or die("Curl to backend_get_questions didn't work");
    print_r($info);
    curl_close($ch);
}
