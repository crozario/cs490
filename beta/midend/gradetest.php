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

$code = "def toDouble(num):
  num *= num
  print(num)";
$code .= "\nimport sys\ntoDouble(int(sys.argv[1]))";
#\nprint(str(sys.argv))
$testCases = array(1=>1, 2=>4, 3=>9);
$grade = 0;
$userName = "hi";
$functionName = "";
$questionId = "";
$testId = "";

file_put_contents("testCode.py", $code) or die("file_put not working");

$counter = 0;
foreach($testCases as $testIn=> $testOut){
    exec('python testCode.py "' . addslashes($testIn) . '"', $output) . '<br>';
    echo 'input: ' . $testIn . ' output: ' . $output[$counter] . '<br>';
    if ($testOut == $output[$counter]){
     $grade += 2;
    }
    $counter++;
}

echo 'Grade: ' . $grade;

$data = array(
    'userName'=>$userName,
    'questionId'=>$questionId,
    'grade'=>$grade
    );

function sendGrades($data, &$JSON){

    #$url = "https://web.njit.edu/~eo65/CS490_project/cs490_alpha/backend/login.php";
    $url = "";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
// print_r($response );
//    if (strpos($response, 'Welcome') == true){
//        $JSON['db'] = "success";
//    } else {
//        $JSON['db'] = "fail";
//    }
    curl_close($ch);
}