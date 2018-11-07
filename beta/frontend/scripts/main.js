var question_bank_array;
var question_bank_exams_array;
var take_exam_name = "";


class Question {
    constructor(question, topic, difficulty) {
        this.question = question;
        this.topic = topic;
        this.difficulty = difficulty;
    }
}

// Login 
function login_button_pressed() {
    var username = document.getElementsByName("username")[0].value;
    var password = document.getElementsByName("password")[0].value;
    var vars = "username=" + username + "&password=" + password;
    var status_id = document.getElementById("status");

    var req = new XMLHttpRequest();

    req.onreadystatechange = function () {
        if (req.readyState == 4) {

            if (req.status == 200) {
                var json_response = JSON.parse(req.responseText);
                var login_response = json_response.login;
                if (login_response == "student") {
                    location.href = "studenthome.html";
                } else if (login_response == "instructor") {
                    location.href = "instructorhome.html";
                } else if (login_response == "fail") {
                    status_id.innerHTML = `<strong>Wrong Username or Password<strong>`;
                } else {
                    // error
                    status_id.innerHTML = login_response;
                }
                // status_id.innerHTML = req.responseText;
            } else {
                status_id.innerHTML = 'An error occurred during your request: ' + req.status + ' ' + req.statusText;
            }
        }
    }

    req.open("POST", "scripts/request.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(vars);
}

// Logout 

function logout_button_pressed() {
    location.href = "index.html";
    // alert("hello");
    // var vars = "get_user_name=true";
    // var req = new XMLHttpRequest();

    // req.onreadystatechange = function () {
    //     if (req.readyState == 4) {

    //         if (req.status == 200) {
    //             // var json_response = JSON.parse(req.responseText);
    //             alert(req.responseText);

    //             location.href = "index.html";
                
    //         } else {
    //             status_id.innerHTML = 'An error occurred during your request: ' + req.status + ' ' + req.statusText;
    //         }
    //     }
    // }

    // req.open("POST", "scripts/request.php", true);
    // req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // req.send(vars);

   
}

// Instructor Home 
function instructorhome_onload() {
    var table = document.getElementById("pending-exams");
    var vars = "get_pending_exams=true";
    var req = new XMLHttpRequest();


    req.onreadystatechange = function () {
        if (req.readyState == 4) {

            if (req.status == 200) {
                var json_response = JSON.parse(req.responseText);
                var exams = json_response;
                // alert(exams);

                for (var i = 0; i < exams.length; i++) {
                    var exam = exams[i].exam;
                    var row = document.createElement("tr");
                    var cell1 = document.createElement("td");
                    cell1.appendChild(document.createTextNode(exam));
                    row.appendChild(cell1);
                    table.children[0].appendChild(row);

                }

                
                // status_id.innerHTML = req.responseText;
            } else {
                status_id.innerHTML = 'An error occurred during your request: ' + req.status + ' ' + req.statusText;
            }
        }
    }

    req.open("POST", "scripts/request.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(vars);
}


// Instructor Exams

function instructor_exams_onload() {
    var table = document.getElementById("question-bank-table-exams");
    var vars = "get_question_bank=true";
    var req = new XMLHttpRequest();


    req.onreadystatechange = function () {
        if (req.readyState == 4) {

            if (req.status == 200) {
                var json_response = JSON.parse(req.responseText);
                // alert(req.responseText);

                // alert(json_response[0].difficulty);
                question_bank_exams_array = new Array();

                for (var i = 0; i < json_response.length; i++) {
                    var question = json_response[i].questionbody;
                    var topic = json_response[i].topic;
                    var difficulty = json_response[i].difficulty;

                    var row = document.createElement("tr");
                    var cell1 = document.createElement("td");
                    var cell2 = document.createElement("td");
                    var cell3 = document.createElement("td");
                    var cell4 = document.createElement("td");
                    cell1.appendChild(document.createTextNode(topic));
                    cell2.appendChild(document.createTextNode(difficulty));
                    cell3.appendChild(document.createTextNode(question));
                    cell4.appendChild(create_question_bank_button(question, topic, difficulty));
                    row.appendChild(cell1);
                    row.appendChild(cell2);
                    row.appendChild(cell3);
                    row.appendChild(cell4);
                    table.children[0].appendChild(row);
                    var question_temp = new Question(question, topic, difficulty);
                    question_bank_exams_array.push(question_temp);
                }

            } else {
                status_id.innerHTML = 'An error occurred during your request: ' + req.status + ' ' + req.statusText;
            }
        }
    }

    req.open("POST", "scripts/request.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(vars);
}


function create_question_bank_button(question, topic, difficulty) {
    var button = document.createElement("button");
    button.innerHTML = "Add";
    button.onclick = function () {
        add_question_to_exam(question, topic, difficulty);
    };
    return button;
}

function add_question_to_exam(question, topic, difficulty) {
    var table = document.getElementById("add-exam-table");
    var row = document.createElement("tr");
    var cell1 = document.createElement("td");
    var cell2 = document.createElement("td");
    var cell3 = document.createElement("td");
    var cell4 = document.createElement("td");
    cell1.appendChild(document.createTextNode(topic));
    cell2.appendChild(document.createTextNode(difficulty));
    cell3.appendChild(document.createTextNode(question));
    cell4.appendChild(add_point_input());
    row.appendChild(cell1);
    row.appendChild(cell2);
    row.appendChild(cell3);
    row.appendChild(cell4);
    table.children[0].appendChild(row);
}

function add_point_input() {
    var input = document.createElement("input");
    input.type = "text";

    return input;
}
function add_exam_button_pressed() {

    var exam_name = document.getElementsByName("exam_name")[0].value;
    var questions = get_exam_questions();
    var points = get_exam_points();
    var vars = "send_exam=true&exam_name=" + exam_name + "&questions=" + questions + "&points=" + points;
    var req = new XMLHttpRequest();

    req.onreadystatechange = function () {
        if (req.readyState == 4) {

            if (req.status == 200) {
                // var json_response = JSON.parse(req.responseText);
                
                // alert("hello");
                clear_create_exam();
                // alert(req.responseText);
                


            } else {
                status_id.innerHTML = 'An error occurred during your request: ' + req.status + ' ' + req.statusText;
            }
        }
    }

    req.open("POST", "scripts/request.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(vars);

}

function clear_create_exam() {
    var table = document.getElementById("add-exam-table");
    document.getElementById("add-exam-input").value = "";
    // alert("hello");
    if (table.rows.length > 1) {
        for (var r = 1, n = table.rows.length; r < n; r++) {
            table.deleteRow(r);
        }
        // table.deleteRow(table.rows.length);
    }
     

}

function get_exam_questions() {
    var table = document.getElementById("add-exam-table");
    var questions_array = new Array();

    for (var r = 1, n = table.rows.length; r < n; r++) {
        var question = table.rows[r].cells[2].innerHTML;
        questions_array.push(question);
    }
    return JSON.stringify(questions_array);
}

function get_exam_points() {
    var table = document.getElementById("add-exam-table");
    var points_array = new Array();

    for (var r = 1, n = table.rows.length; r < n; r++) {
        var points = table.rows[r].cells[3].children[0].value;
        points_array.push(points);
    }
    return JSON.stringify(points_array);
}

// Question Bank
function question_bank_onload() {
    var table = document.getElementById("question-bank-table");
    var vars = "get_question_bank=true";
    var req = new XMLHttpRequest();


    req.onreadystatechange = function () {
        if (req.readyState == 4) {

            if (req.status == 200) {
                var json_response = JSON.parse(req.responseText);
                // alert(req.responseText);

                // alert(json_response[0].difficulty);
                question_bank_array = new Array();

                for (var i = 0; i < json_response.length; i++) {
                    var question = json_response[i].questionbody;
                    var topic = json_response[i].topic;
                    var difficulty = json_response[i].difficulty;

                    var row = document.createElement("tr");
                    var cell1 = document.createElement("td");
                    var cell2 = document.createElement("td");
                    var cell3 = document.createElement("td");
                    cell1.appendChild(document.createTextNode(topic));
                    cell2.appendChild(document.createTextNode(difficulty));
                    cell3.appendChild(document.createTextNode(question));
                    row.appendChild(cell1);
                    row.appendChild(cell2);
                    row.appendChild(cell3);
                    table.children[0].appendChild(row);
                    var question_temp = new Question(question, topic, difficulty);
                    question_bank_array.push(question_temp);
                }

            } else {
                status_id.innerHTML = 'An error occurred during your request: ' + req.status + ' ' + req.statusText;
            }
        }
    }

    req.open("POST", "scripts/request.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(vars);
}

function add_question_button_pressed() {
    var question = document.getElementById("question").value;
    var function_name = document.getElementById("function-name").value;
    var topic_options = document.getElementById("topic-select");
    var topic = topic_options.options[topic_options.selectedIndex].value;
    var difficulty_options = document.getElementById("difficulty-select");
    var difficulty = difficulty_options.options[difficulty_options.selectedIndex].value;
    var table = document.getElementById("test-cases-table");

    var input_str = "";
    var output_str = "";
    for (var r = 1, n = table.rows.length; r < n; r++) {
        var cell1_value = table.rows[r].cells[0].children[0].value;
        var cell2_value = table.rows[r].cells[1].children[0].value;
        if (r == table.rows.length - 1) {
            input_str += cell1_value;
            output_str += cell2_value;
        } else {
            input_str += cell1_value + ":";
            output_str += cell2_value + ":";
        }

    }

    var vars = "add_question=true" + "&question=" + question + "&function_name=" + function_name + "&topic=" + topic + "&difficulty=" + difficulty + "&test_case_in=" + input_str + "&test_case_out=" + output_str;
    var req = new XMLHttpRequest();


    req.onreadystatechange = function () {
        if (req.readyState == 4) {

            if (req.status == 200) {
                var json_response = JSON.parse(req.responseText);
                // alert(json_response.added);
                if (json_response.added == true) {
                    // alert("hello");
                    var question_temp = new Question(question, topic, difficulty);
                    question_bank_array.push(question_temp);
                    add_to_question_bank(question_temp);
                    clear_create_question_form()
                    // alert(question_bank_array[0].question);
                } else {
                    // alert(false);
                }
                // status_id.innerHTML = req.responseText;
            } else {
                status_id.innerHTML = 'An error occurred during your request: ' + req.status + ' ' + req.statusText;
            }
        }
    }

    req.open("POST", "scripts/request.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(vars);

}

function add_to_question_bank(question_object) {
    var table = document.getElementById("question-bank-table");
    var row = document.createElement("tr");
    var cell1 = document.createElement("td");
    var cell2 = document.createElement("td");
    var cell3 = document.createElement("td");
    cell1.appendChild(document.createTextNode(question_object.topic));
    cell2.appendChild(document.createTextNode(question_object.difficulty));
    cell3.appendChild(document.createTextNode(question_object.question));
    row.appendChild(cell1);
    row.appendChild(cell2);
    row.appendChild(cell3);
    table.children[0].appendChild(row);
    // alert("hello");
}

function clear_create_question_form() {
    document.getElementById("question").value = "";
    document.getElementById("function-name").value = "";
    document.getElementById("topic-select").selectedIndex = 0;
    document.getElementById("difficulty-select").selectedIndex = 0;
    var table = document.getElementById("test-cases-table");
    table.rows[1].cells[0].children[0].value = "";
    table.rows[1].cells[1].children[0].value = "";

    if (table.rows.length > 2) {
        for (var r = 2, n = table.rows.length; r < n; r++) {
            table.deleteRow(r);
        }
    }

}


function add_test_case_button() {
    var table = document.getElementById("test-cases-table");
    var input = document.createElement("input");
    input.type = "text";
    var input2 = document.createElement("input");
    input2.type = "text";
    var row = document.createElement("tr");
    var cell1 = document.createElement("td");
    var cell2 = document.createElement("td");
    cell1.appendChild(input);
    cell2.appendChild(input2);
    row.appendChild(cell1);
    row.appendChild(cell2);
    table.children[0].appendChild(row);

}

function create_remove_button_test_case() {
    var button = '<button>Remove</button>'
    button.onclick = function () {
        console.log("hello")
    }
    return button;
}

// Student Home

function student_home_onload() {
    // var table = document.getElementById("pending-exams-student");
    var vars = "get_user_name=true";

    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
        if (req.readyState == 4) {

            if (req.status == 200) {
                var uname = req.responseText;   

                

                                      
            } else {
                status_id.innerHTML = 'An error occurred during your request: ' + req.status + ' ' + req.statusText;
            }
        }
    }

    req.open("POST", "scripts/request.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(vars);

    // var row = document.createElement("tr");
    // var cell1 = document.createElement("td");
    // var cell2 = document.createElement("td");
    // var cell3 = document.createElement("td");
    // cell1.appendChild(document.createTextNode(question_object.topic));
    // cell2.appendChild(document.createTextNode(question_object.difficulty));
    // cell3.appendChild(document.createTextNode(question_object.question));
    // row.appendChild(cell1);
    // row.appendChild(cell2);
    // row.appendChild(cell3);
    // table.children[0].appendChild(row);


}


// Take Exam

function take_exam_onload() {


    var vars = "take_exam_student=true";
    var req = new XMLHttpRequest();


    req.onreadystatechange = function () {
        if (req.readyState == 4) {

            if (req.status == 200) {
                // alert(JSON.parse(req.responseText)[0].question);
                var questions = JSON.parse(req.responseText);
                // alert(questions.length);

                // var questions = json_response.questions;
                // var points = json_response.points;
                
                var table = document.getElementById("take-exam-table");
                var exam_name = document.getElementById("take-exam-name");
                exam_name.innerHTML = questions[0].exam;

                for (i = 0; i < questions.length; i++) {
                    var row = document.createElement("tr");
                    var cell1 = document.createElement("label");
                    var cell2 = document.createElement("td");
                    cell1.appendChild(document.createTextNode("Question:"));
                    cell2.appendChild(document.createTextNode(questions[i].question));
                    row.appendChild(cell1);
                    row.appendChild(cell2);
                    table.children[0].appendChild(row);

                    row = document.createElement("tr");
                    cell1 = document.createElement("label");
                    cell2 = document.createElement("td");
                    cell1.appendChild(document.createTextNode("Points:"));
                    cell2.appendChild(document.createTextNode(questions[i].points));
                    row.appendChild(cell1);
                    row.appendChild(cell2);
                    table.children[0].appendChild(row);

                    row = document.createElement("tr");
                    cell1 = document.createElement("label");
                    cell2 = document.createElement("td");
                    cell1.appendChild(document.createTextNode("Answer:"));
                    cell2.appendChild(add_answer_textarea());
                    row.appendChild(cell1);
                    row.appendChild(cell2);
                    table.children[0].appendChild(row);
                }
            } else {
                status_id.innerHTML = 'An error occurred during your request: ' + req.status + ' ' + req.statusText;
            }
        }
    }

    req.open("POST", "scripts/request.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(vars);

}

function add_answer_textarea() {
    var input = document.createElement("textarea");
    input.cols = "50";
    input.rows = "5";

    return input;
}

function take_exam_submit_button_pressed() {
    var table = document.getElementById("take-exam-table");
    var exam_name = document.getElementById("take-exam-name").innerHTML;
    // var questions = new Array();
    // var points = new Array();
    var answers = new Array();
    var user_name = "ez90";
    // alert("hello");
    // alert(table.rows.length);
    var i = 3;
    while (i < table.rows.length) {
        // var question = table.rows[i++].cells[0].innerHTML;
        // var point = table.rows[i++].cells[0].innerHTML;
        var answer = table.rows[i].cells[0].children[0].value;
        i+=3;
        // questions.push(question);
        // points.push(point);
        answers.push(answer);
    } 

    // questions_stringified = JSON.stringify(questions);
    // points_stringified = JSON.stringify(points);
    answers_stringified = JSON.stringify(answers);

    // alert(answers_stringified);
    var vars = "take_exam_submit=true"+"&user_name="+user_name+"&exam_name="+exam_name+"&answers="+answers_stringified;
    
    var req = new XMLHttpRequest();

    req.onreadystatechange = function () {
        if (req.readyState == 4) {

            if (req.status == 200) {
                alert(req.responseText);
                // var json_response = JSON.parse(req.responseText);
                // alert(json_response.added);
                // location.href = "login.html";
            } else {
                status_id.innerHTML = 'An error occurred during your request: ' + req.status + ' ' + req.statusText;
            }
        }
    }
    req.open("POST", "scripts/request.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(vars);

    // var vars = "get_user_name=true";
    // var req = new XMLHttpRequest();


    // req.onreadystatechange = function () {
    //     if (req.readyState == 4) {

    //         if (req.status == 200) {
    //             var json_response = JSON.parse(req.responseText);
    //             username = json_response;
    //             // var json_response = JSON.parse(req.responseText);
    //             // alert(json_response.added);
    //             // location.href = "login.html";
    //         } else {
    //             status_id.innerHTML = 'An error occurred during your request: ' + req.status + ' ' + req.statusText;
    //         }
    //     }
    // }

    // req.open("POST", "scripts/request.php", true);
    // req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // req.send(vars);

    // alert(username);

}

