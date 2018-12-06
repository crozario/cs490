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
$exam = $_POST['exam'];
$user = $_POST['user'];
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

//exit(); //before grading
#TODO: addslashes to testin just to be safe
foreach ($questions as $key=>$question){
    echo '<br>' . $answers[$key] . '<br>' . $testCasesIn[$key] . '<br>' . $testCasesOut[$key] . '<br>' . $functionName[$key] .'<br>';
    echo $question . '<br>' . $pointsValue[$key] . '<br>';
    $testCases = array();
    stringToArray($testCasesIn[$key], $testCasesOut[$key], $testCases);
    //bool to keep track of functionname and constraint being correct
    $validFuncName = true;
    $validConstName = true;
    $printOut = false;

    $rawCode = $answers[$key];
    $code = "";
    $funcName = $functionName[$key];
    $originalPointsPerTest = $pointsValue[$key]/(count($testCases));
    $pointsPerTest = $originalPointsPerTest;
    echo "points for question: ". $pointsValue[$key] . " points per test: " .$originalPointsPerTest . " test cases #: ".count($testCases).'<br>';

    //finds function name in answer
    $matches = array();
    preg_match_all("/[\w\d]+\(/", $rawCode, $matches);
    if (substr($matches[0][0],0,-1) == $funcName){
        echo "functionName was correct";
        $code = $rawCode;
//        $pointsPerTest = $originalPointsPerTest;
    }
    else {
        //replace function name if wrong
        $matches = array();
        preg_match_all("/[\w\d]+/", $rawCode, $matches);
        $search = $matches[0][1];
        $code = str_replace($search,$funcName,$rawCode);
        print_r("functionName replaced");
        echo '<br>'.'old name: '.strlen($funcName). ' new name: '. strlen($search) . '<br>';
        echo '<br>'.'old name: '.$funcName. ' new name: '. $search . '<br>';
//        $pointsPerTest = $originalPointsPerTest*0.8;
        $validFuncName = false;
    }
    //adding colon in first line if not present, might cause problems in different browsers
    $matches = array();
    echo '<br> code before colon: ' . $code . '<br>';
    preg_match_all("/.*[\r\n|\r|\n]/", $code, $matches);
    if (strpos($matches[0][0], ":") === false){
    $colon = substr_replace($matches[0][0], ":\n", strlen($matches[0][0])-1);
    $code = str_replace($matches[0][0],$colon,$code);
    echo '<br> code after colon: ' . $code . '<br>';
    echo '<br> colon added <br>';
    }
//  decides if function call should have print
    if (strpos($code, 'return') == true){
        $printOut = true;
    }
//  checks for constraint
    if (($constraints[$key] == 'none' || $constraints[$key] == '') == true){
        //no constraint
    }
    elseif (($constraints[$key] == 'recursion') == true){
        //doesn't matter
    }
    elseif (strpos($code, $constraints[$key]) == true){
        //constraint found (while or for)
    }
    else {
        //$pointsPerTest = $pointsPerTest - $originalPointsPerTest*0.2;
        echo '<br>'."constraint not found: ".$constraints[$key].'<br>';
        $validConstName = false;
//        echo '<br>'.$constraints[$key] == null.'<br>';
    }
    if (!$validFuncName && !$validConstName){
        $pointsPerTest = $originalPointsPerTest * .8;
    }
    elseif ($validFuncName && $validConstName){
        //do nothing
    }
    else {
        //10% off for having either funcName or Const wrong
        $pointsPerTest = $originalPointsPerTest * .9;
    }
    $counter = 0;
    $output = array();
    foreach($testCases as $testIn=> $testOut){
//  divide pointsValue[x] by testCases[x] and assign that value for each correct test case
        if($printOut){
            $codeTemp = $code . "\nprint($funcName($testIn))";
        }
        else {
            $codeTemp = $code . "\n$funcName($testIn)";
        }
        file_put_contents("testCode.py", $codeTemp) or die("file_put not working");
        exec("timeout 5 python testCode.py", $output);
//  echo $out . '<br>';
        echo '<br>' ."input: " . $testIn;
        echo 'expectedOut: ' . $testOut . ' actualOut: ' . $output[$counter]. '<br>';
        $grade = 0;
        if ($testOut == $output[$counter]){
            echo 'output was correct' . '<br>';
            $grade = $pointsPerTest;
            echo $grade. '<br>';
//            $totalGrade += $pointsPerTest;
        }
//  post to back end records table for each test case, also provide studentid and examid and funcname & const bool and rawanswer
        $postArray = array('constraint'=>addslashes($validConstName), 'funcName'=>addslashes($validFuncName), 'testcasesin'=>addslashes($testIn), 'expectedtestcaseout'=>addslashes($testOut), 'points'=>$originalPointsPerTest, 'autograde'=>$grade, 'testcasesout'=>addslashes($output[$counter]), 'user'=>$user, 'exam'=>$exam, 'question'=>addslashes($questions[$key]), 'answer'=>addslashes($rawCode));
        echo "POST: " . $counter . '<br>';
        sendGrades($postArray);
        #var_dump($postArray) . '<br>';
        $counter++;
    }
//    $postArray = array('user'=>$user, 'exam'=>$exam, 'question'=>addslashes($questions[$key]), 'answer'=>addslashes($code), 'autograde'=>$totalGrade);
//    sendGrades($postArray);
}


function sendGrades($data){

    $url = "https://web.njit.edu/~eo65/cs490/beta/backend/addpoints.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    //should probably print success or fail for adding grades for a test
//    print_r($response );

    curl_close($ch);
}

function retrieveData(&$response, $url, $data){
    //https://web.njit.edu/~eo65/cs490/beta/backend/showquestiontostudent.php
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = (curl_exec($ch));
//    print_r($response);
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
