<?php
/**
 * Created by IntelliJ IDEA.
 * User: furqan
 * Date: 10/11/18
 * Time: 12:24 AM
 */
# TODO: receive answer, test cases from front
# TODO: grade answer using test cases
# TODO: POST grade and answer with test cases to backend

//$code = "def double(num):
//  print(num*2)";
//$grade = 0;
//$userName = "";
//$questionId = "";
//$testId = "";
//echo file_get_contents("php://input");
$code = $_POST['answer'];
$testCaseIn = $_POST['testCasesIn'];
$testCaseOut = $_POST['testCasesOut'];
$functionName = $_POST['functionName'];

//student has to put in space after function name in def
$answerArray = explode(' ', $code);
//echo var_dump($answerArray) . '<br>';
if ($answerArray[1] == $functionName){
    $grade += 2;
}
else {
    $answerArray[1] = $functionName;
    $code = implode(' ', $answerArray);
}

if (strpos($code, 'return') == true){
    $printOut = true;
}

$testCases = array();
stringToArray($testCaseIn, $testCaseOut, $testCases);
//var_dump($testCases);

$counter = 0;
foreach($testCases as $testIn=> $testOut){
    if($printOut){
        $codeTemp = $code . "\nprint($functionName($testIn))";
    }
    else {
        $codeTemp = $code . "\n$functionName($testIn)";
    }
//    echo $codeTemp . '<br>';
    file_put_contents("testCode.py", $codeTemp) or die("file_put not working");
    exec("python testCode.py", $output) . '<br>';
//    echo $out . '<br>';
    echo 'input: ' . $testIn . ' output: ' . $output[$counter] . '<br>';
//    echo 'expectedOut: ' . $testOut . ' actualOut: ' . $output[$counter]. '<br>';
    if ($testOut == $output[$counter]){
        $grade += 2;
    }
    $counter++;
}

echo 'Grade: ' . $grade;

$testCaseInArray = explode(':', $testCaseIn);

$data = array(
    'userName'=>$userName,
    'questionId'=>$questionId,
    'grade'=>$grade
    );

function sendGrades($data, &$JSON){

    $url = "";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    //should probably print success or fail for adding grades for a test
    print_r($response );
//    if (strpos($response, 'Welcome') == true){
//        $JSON['db'] = "success";
//    } else {
//        $JSON['db'] = "fail";
//    }
    curl_close($ch);
}

//creates an array of int=>string pairs
function stringToArray($testCaseIn, $testCaseOut, &$testCases){
    $testCaseInArray = explode(':', $testCaseIn);
    $testCaseOutArray = explode(':', $testCaseOut);
    for ($x=0; $x < count($testCaseOutArray); $x++){
        $testCases[$testCaseInArray[$x]] = $testCaseOutArray[$x];
    }
}
