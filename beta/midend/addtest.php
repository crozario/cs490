<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 10/13/18
 * Time: 12:10 AM
 */

//probably should have testId, questionIds, instructorId

$data = array(
    'examName'=>'Exam 1',
    'question1'=>'question1',
    'points1'=>10,
    'question2'=>'question2',
    'points2'=>15,
    'question3'=>'question3',
    'points3'=>20
);

//foreach question add to data array
//foreach ($_POST as $key => $value) {
//    //do something
//    echo $key . ' has the value of ' . $value . '<br>';
//    $data[$key]=$value;
//}
var_dump($data);

//POST Exam data to backend, backend creates Exam entry
function sendTest($data){

    $url = "backend";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    var_dump($data);
//    echo '<br>';

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
