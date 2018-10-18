<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 10/13/18
 * Time: 12:10 AM
 */

//probably should have testId, questionIds, instructorId
$examName = $_POST['exam_name']; //'Exam1';
$questionArray = json_decode($_POST['questions']); //array('This is question1');
$pointsValue = json_decode($_POST['points']); //array(10);

//echo var_dump($pointsValue). '<br>';
//echo var_dump($questionArray). '<br>';
//echo $examName . ' '. var_dump($questionArray). ' '. var_dump($pointsValue);

//foreach question add to data array
//foreach ($_POST as $key => $value) {
//    //do something
//    echo $key . ' has the value of ' . $value . '<br>';
//    $data[$key]=$value;
//}

//var_dump($data);

//POST Exam data to backend, one question at a time
for ($x=0; $x<count($questionArray);$x++){
    $data = array(
        'examName'=>$examName,
        'question'=>$questionArray[$x],
        'points'=>$pointsValue[$x]
    );
    sendTest($data);
}

//$data = array(
//    'examName'=>'Exam1',
//    'question'=>'This is question1',
//    'points'=>10
//);
//
//    sendTest($data);

function sendTest($data){

    $url = "https://web.njit.edu/~eo65/cs490/beta/backend/addtest.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    var_dump($data);
    echo '<br>';

    $response = curl_exec($ch) or die("Curl to backend_add_test didn't work");
    //backend should probably print success or fail for adding test
    print_r($response );
//    if (strpos($response, 'Welcome') == true){
//        $JSON['db'] = "success";
//    } else {
//        $JSON['db'] = "fail";
//    }
    curl_close($ch);
}
