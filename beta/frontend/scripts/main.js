function loginButtonPressed() {
    var username = document.getElementsByName('username')[0].value;
    var password = document.getElementsByName('password')[0].value;
    var vars = "username="+username+"&password="+password;
    var status_id = document.getElementById('status');

    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
        if(req.readyState == 4) {
        
            if (req.status == 200) {
                var json_response = JSON.parse(req.responseText);
                // var login_response = json_response.login;
                var login_response = "student";

                if (login_response == "student") {
                    location.href = "student.html";
                } else if (login_response == "instructor")  {
                    location.href = "instructor.html";
                } else if (login_response == "fail") {
                    status_id.innerHTML = `<strong>Wrong Username or Password<strong>`;
                } else {
                    // error
                }
                
            } else {
                status_id.innerHTML = 'An error occurred during your request: ' +  req.status + ' ' + req.statusText;
            }           
        }  
    }

    req.open("POST", "scripts/request.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(vars); 
}
