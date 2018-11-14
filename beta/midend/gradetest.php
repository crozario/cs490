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

//read questions from the showquestiontostudent
$exam = 'exam1';//$_POST['exam'];
$user = 'ez90';//$_POST['user'];
$data = array(
    'exam'=>$exam,
    'user'=>$user
);
//questions,testcases,etc URL
$url = "https://web.njit.edu/~eo65/cs490/beta/backend/gradetest.php";
$info = "";
retrieveData($info, $url,$data);
$obj = json_decode($info);
//arrays to store all the testcases,etc for each question

$testCasesIn = array();
$testCasesOut = array();
$functionName = array();
$questions = array();
$pointsValue = array();
$constraints = array();

foreach ($obj as $item)
{
    $questions[] = $item->question;
    $pointsValue[] = $item->points;
    $testCasesIn[] = $item->testcasein;
    $testCasesOut[] = $item->testcaseout;
    $functionName[] = $item->functionName;
    $constraints[] = $item->constraints;
}

$url = "https://web.njit.edu/~eo65/cs490/beta/backend/showstudentanswer.php";
retrieveData($info, $url, $data);

$obj = json_decode($info);
//array to store all the exam answers
$answers = array();

foreach ($obj as $item)
{
    $answers[] = $item->answer;
    //add constraint array later
//    echo 'question: ' . $question . ' points: '.$points . '<br>';
}
#TODO: addslashes to testin just to be safe
foreach ($questions as $key=>$question){
//    echo '<br>' . $answers[$key] . $testCasesIn[$key] . $testCasesOut[$key] . $functionName[$key] .'<br>';
//    echo $question . $pointsValue[$key];
    $testCases = array();
    stringToArray($testCasesIn[$key], $testCasesOut[$key], $testCases);
    //bool to keep track of functionname and constraint being correct
    $funcName = true;
    $constName = true;

    $code = $answers[$key];
    $functionName = $functionName[$key];
    $pointsPerTest = $pointsValue[$key]/(count($testCases));
    echo "points for question: ". $pointsValue[$key] . " points per test: " .$pointsPerTest . " test cases #: ".count($testCases).'<br>';
    $totalGrade = 0;
    //finds function name in answer
    if (strpos($code, $functionName) == true){
        echo "functionName was correct";
//        $pointsPerTest = $originalPointsPerTest;
    }
    else {
        //replace function name if wrong
        $matches = array();
        preg_match_all("/[\w\d]+/", $code, $matches);
        $search = $matches[0][1];
        $code = str_replace($search,$functionName,$code);
        echo '<br>';
        print_r("functionName replaced");
//        $pointsPerTest = $originalPointsPerTest*0.8;
        $funcName = false;
    }
//  decides if function call should have print
    if (strpos($code, 'return') == true){
        $printOut = true;
    }
//  checks for constraint
    if (($constraints[$key] == null) == true){
        //no constraint
    }
    elseif (strpos($code, $constraints[$key]) == true){
        //constraint found
    }
    else {
        //$pointsPerTest = $pointsPerTest - $originalPointsPerTest*0.2;
        echo '<br>'."constraint not found: ".$constraints[$key].'<br>';
        $constName = false;
//        echo '<br>'.$constraints[$key] == null.'<br>';
    }

    $counter = 0;
    foreach($testCases as $testIn=> $testOut){
//  divide pointsValue[x] by testCases[x] and assign that value for each correct test case
        if($printOut){
            $codeTemp = $code . "\nprint($functionName($testIn))";
        }
        else {
            $codeTemp = $code . "\n$functionName($testIn)";
        }
//  echo $codeTemp . '<br>';
        file_put_contents("testCode.py", $codeTemp) or die("file_put not working");
        exec("python testCode.py", $output);
//  echo $out . '<br>';
        echo '<br>' ."input: " . $testIn . ' output: ' . $output[$counter] . '<br>';
        echo 'expectedOut: ' . $testOut . ' actualOut: ' . $output[$counter]. '<br>';
        $grade = 0;
        if ($testOut == $output[$counter]){
            $grade = $pointsPerTest;
            $totalGrade += $pointsPerTest;
        }
//  post to back end records table for each test case, also provide studentid and examid
        $postArray = array('testcasesin'=>addslashes($testIn), 'expectedtestcaseout'=>$testOut, 'points'=>$grade, 'testcasesout'=>$output[$counter], 'user'=>$user, 'exam'=>$exam, 'question'=>$questions[$key], 'answer'=>addslashes($code));
        echo "POST: " . $counter . '<br>';
        sendGrades($postArray);
//        echo var_dump($postArray) . '<br>';
        $counter++;
    }
    $postArray = array('user'=>$user, 'exam'=>$exam, 'question'=>$questions[$key], 'answer'=>addslashes($code), 'autograde'=>$totalGrade);
    sendGrades($postArray);
}

//exit();
// questions and points are stored in respective arrays
//echo var_dump($obj[0]) . '<br>';
//echo $obj[0]->questions . '<br>';
//echo $obj[0]->points . '<br>';

//read in the following fields:
//$url = "https://web.njit.edu/~ak697/cs490/cs490-beta/fortestcasesandanswer.php";


//answers, testCasesIn, testCasesOut, and functionName are stored in respective arrays


//make sure to return the old answer instead of the modified one
//$code = "def operatin(op, a, b):
//    if op == '+':
//        print  a+b
//    elif op == '-':
//        print a-b
//    elif op == '*':
//        print a*b
//    elif op == '/':
//        print a/b
//    else:
//        print \"eror\"";
//
//$testCaseIn = "'+',3,4:'-',13,5:'/',20,4:'*',7,7:'#',8,9";
//$testCaseOut = "7:8:5:49:error";
//$functionName = "operation";

//finds function name in answer
//if (strpos($code, $functionName) == true){
//    print_r('functionName was correct\n');
//}
//else {
//    //replace first occurence of the word before '(' if function name is wrong
//    $matches = array();
//    preg_match_all("/[\w\d]+/", $code, $matches);
//    $search = $matches[0][1];
//    $code = str_replace($search,$functionName,$code);
//    echo '<br>';
//    print_r('functionName replaced');
//}
//
//if (strpos($code, 'return') == true){
//    $printOut = true;
//}
//
////constraint yet to be defined
////if (strpos($code, $constraint) == true){
////    $printOut = true;
////}
//
//$testCases = array();
//stringToArray($testCaseIn, $testCaseOut, $testCases);
////var_dump($testCases);
//
//$counter = 0;
//foreach($testCases as $testIn=> $testOut){
////divide pointsValue[x] by testCases[x] and assign that value for each correct test case
//    if($printOut){
//        $codeTemp = $code . "\nprint($functionName($testIn))";
//    }
//    else {
//        $codeTemp = $code . "\n$functionName($testIn)";
//    }
////    echo $codeTemp . '<br>';
//    file_put_contents("testCode.py", $codeTemp) or die("file_put not working");
//    exec("python testCode.py", $output) . '<br>';
////    echo $out . '<br>';
////    echo 'input: ' . $testIn . ' output: ' . $output[$counter] . '<br>';
////    echo 'expectedOut: ' . $testOut . ' actualOut: ' . $output[$counter]. '<br>';
//    if ($testOut == $output[$counter]){
//        $grade = $pointsValue[$key];
//    }
//    else { $grade = 0; }
//    //post here to back end records table for each test case, also provide studentid and examid
//    $postArray = array('testcasesin'=>addslashes($testIn), 'expectedtestcaseout'=>$testOut, 'points'=>$grade, 'testcasesout'=>$output[$counter], 'user'=>'rp567', 'exam'=>'exam2', 'question'=>'write a function that can divide, multiply, add, and subtract based on an op and two integer inputs', 'answer'=>addslashes($code));
//    echo "POST: " . $counter . '<br>';
////    sendGrades($postArray);
//    echo var_dump($postArray) . '<br>';
//    $counter++;
//}

//echo 'Grade: ' . $grade;

function sendGrades($data){

    $url = "https://web.njit.edu/~eo65/cs490/beta/backend/addpoints.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    //should probably print success or fail for adding grades for a test
    print_r($response );

    curl_close($ch);
}

function retrieveData(&$response, $url, $data){
    //https://web.njit.edu/~eo65/cs490/beta/backend/showquestiontostudent.php
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = (curl_exec($ch));
    print_r($response);
    //should probably print success or fail for adding grades for a test
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
