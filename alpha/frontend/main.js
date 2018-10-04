

function loginButtonPressed() {

    var username = document.getElementsByName('username')[0].value;
    var password = document.getElementsByName('password')[0].value;
    var vars = "username="+username+"&password="+password;
    var status_id = document.getElementById('status');

    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
        if(req.readyState == 4) {
        
            if (req.status == 200) {
                // var response_json = JSON.parse(req.responseText);
                // var njit_response = response_json.njit;
                // var db_response = response_json.db;

                // var response_string = `NJIT = ${njit_response}\nDB = ${db_response}`;

                // status_id.innerHTML = response_string;
                status_id.innerHTML = req.responseText;

            } else {
                status_id.innerHTML = 'An error occurred during your request: ' +  req.status + ' ' + req.statusText;
            }           
        }  
    }
    
    req.open("POST", "request.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(vars); 

}

