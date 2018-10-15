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

//$code = "def multiply(num1, num2):
//  product = num1 * num2
//  print(product)";
$code = "def toDouble(num):
  num *= num
  print(num)";
#\nprint(str(sys.argv))
$testCaseIn = '1 2,2 3,3 4';
$testCaseOut = '2,6,12';
$grade = 0;
$userName = "hi";
$functionName = "";
$questionId = "";
$paramType = "singleInt";
$testId = "";
$testCases = array();

var_dump($testCases);
echo '<br>';

switch($paramType){
    case 'singleInt':
        $code .= "\nimport sys\ntoDouble(int(sys.argv[1]))";
        file_put_contents("testCode.py", $code) or die("file_put not working");
        stringToArray($testCaseIn, $testCaseOut, $testCases);

        $counter = 0;
        foreach($testCases as $testIn=> $testOut){
            exec("python testCode.py $testIn", $output) . '<br>';
            echo 'input: ' . $testIn . ' output: ' . $output[$counter] . '<br>';
            if ($testOut == $output[$counter]){
                $grade += 2;
            }
            $counter++;
        }
        break;
    case 'multiInt':
        $code .= "\nimport sys\nmultiply(int(sys.argv[1])";
        //for each number in param, add another arg
        for($x=2; $x <=2;$x++){
            $code .= ", int(sys.argv[$x])";
        }
        $code .= ")";
//        echo $code . '<br>';
        file_put_contents("testCode.py", $code) or die("file_put not working");

        stringToArray($testCaseIn, $testCaseOut, $testCases);
//        var_dump($testCases);
//        echo '<br>';

        $counter = 0;
        foreach($testCases as $testIn=> $testOut){
            exec("python testCode.py $testIn", $output) . '<br>';
            echo 'input: ' . $testIn . ' output: ' . $output[$counter] . '<br>';
            if ($testOut == $output[$counter]){
                $grade += 2;
            }
            $counter++;
        }

        break;
    default:
        echo 'unrecognized question type <br>';
}

//$counter = 0;
//foreach($testCases as $testIn=> $testOut){
//    exec('python testCode.py "' . addslashes($testIn) . '"', $output) . '<br>';
//    echo 'input: ' . $testIn . ' output: ' . $output[$counter] . '<br>';
//    if ($testOut == $output[$counter]){
//     $grade += 2;
//    }
//    $counter++;
//}

echo 'Grade: ' . $grade;

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
    $testCaseInArray = explode(',', $testCaseIn);
    $testCaseOutArray = explode(',', $testCaseOut);
    for ($x=0; $x < count($testCaseOutArray); $x++){
        $testCases[$testCaseInArray[$x]] = $testCaseOutArray[$x];
    }
}
