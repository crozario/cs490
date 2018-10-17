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



// Instructor Home 
function instructorhome_onload() {
    var table = document.getElementById("pending-exams");
    var vars = "get_pending_exams=true";
    var req = new XMLHttpRequest();


    req.onreadystatechange = function () {
        if (req.readyState == 4) {

            if (req.status == 200) {
                var json_response = JSON.parse(req.responseText);
                var found_exams = json_response.found_exams;

                if (found_exams == true) {
                    var exams = json_response.exams;
                    for (var i = 0; i < exams.length; i++) {
                        var exam = exams[i];
                        var row = table.insertRow(table.rows.length);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        
                        cell1.innerHTML = exam;

                        if (exam.scores_released == true) {
                            cell2.innerHTML = "Yes"
                            cell3.innerHTML = "Release Button (OFF)"
                        } else {
                            cell2.innerHTML = "No"
                            cell3.innerHTML = "Review Button"
                        }
                    }

                    var row = table.insertRow(0);

                } else if (found_exams == false) {
                    //don't add any
                } else {
                    //error
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


// Instructor Exam



// Question Bank
function question_bank_onload() {
    var table = document.getElementById("question-bank-table");
    var vars = "get_question_bank=true";
    var req = new XMLHttpRequest();


    req.onreadystatechange = function () {
        if (req.readyState == 4) {

            if (req.status == 200) {
                var json_response = JSON.parse(req.responseText);
                var found_exams = json_response.found_exams;

                if (found_exams == true) {
                    var exams = json_response.exams;
                    for (var i = 0; i < exams.length; i++) {
                        var exam = exams[i];
                        var row = table.insertRow(table.rows.length);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        
                        cell1.innerHTML = exam;

                        if (exam.scores_released == true) {
                            cell2.innerHTML = "Yes"
                            cell3.innerHTML = "Release Button (OFF)"
                        } else {
                            cell2.innerHTML = "No"
                            cell3.innerHTML = "Review Button"
                        }
                    }

                    var row = table.insertRow(0);

                } else if (found_exams == false) {
                    //don't add any
                } else {
                    //error
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

function add_question_button_pressed() {
    var question = document.getElementById("question");
    var function_name = document.getElementById("function-name");
    var function_parameters = document.getElementById("function-parameters");
    var topic = document.getElementById("topic");
}

function add_test_case_button() {
    var table = document.getElementById("test-cases-form");
    var row = table.insertRow(table.rows.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(1);
    cell1.innerHTML = '<input type="text">';
    cell2.innerHTML = '<input type="text">';
    cell3.innerHTML = create_remove_button_test_case();
}

function create_remove_button_test_case() {
    var button = documer
}

// Instructor Exam List
function add_exam_button_pressed() {
    // var table = document.getElementById("exam-list-table");
    // var exam_name = document.getElementsByName("exam_name")[0].value;
    // var topics = "";
    // var difficulties = "";
    // var action = "NONE";


    // var row = table.insertRow(table.rows.length);
    // var cell1 = row.insertCell(0);
    // var cell2 = row.insertCell(1);
    // var cell3 = row.insertCell(2);
    // var cell4 = row.insertCell(3);
    // var cell5 = row.insertCell(4);

    // cell1.innerHTML = exam_name;
    // cell2.innerHTML = get_current_date_time();
    // cell3.innerHTML = topics;
    // cell4.innerHTML = difficulties;
    // cell5.innerHTML = create_table_action_buttons();

    // var row = table.insertRow(0);
    var exam_name = document.getElementsByName("exam_name")[0].value;

    var vars = "send_exam=true";
    var req = new XMLHttpRequest();


    req.onreadystatechange = function () {
        if (req.readyState == 4) {

            if (req.status == 200) {
                var json_response = JSON.parse(req.responseText);


          
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

function get_current_date_time() {
    var date = new Date();
    var date_str = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear() + " " + date.getHours() + ":" + date.getMinutes();
    return date_str;
}

// function create_table_action_buttons() {
//     var btn = "<button class= "add-exam-button" type="button" onclick="add_exam_button_pressed();">Add Exam</button>"
//     return btn;
// }


