

function loginButtonOnClick() {

    var username = document.getElementsByName('username')[0].value;
    var password = document.getElementsByName('password')[0].value;
    var vars = "username="+username+"&password="+password;
    var status_id = document.getElementById('status');

    // fetch('/main.php', {
    //         method: 'POST',
    //         headers: {
    //             'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
    //             'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
    //         },
    //         body: data.join(vars)
    //     }).then(function (response) {
    //             //alert(response);
    //             status = response.status;  // Get the HTTP status code
    //             response_ok = response.ok;
    //             console.log('response')
    //             return response.json();
    //         })
    //         .then(function (result) {
                
    //             // if (result.success = true && result.id != '') {
    //             // }
    //             document.getElementById('status').innerHTML = result.responseText;
        
    //         })
    //         .catch(function (error) {
    //             console.log('Request failed', error);
    // });

   
    console.log(username);
    console.log(password);

    console.log(vars);

    var req = new XMLHttpRequest();
    
    req.open("POST", "main.php", true);
    // req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    req.getAllResponseHeaders();
    req.send(vars); 

    req.onreadystatechange = function() {
        if(req.readyState == 4) {
        
            if (req.status == 200) {
                console.log("data received");
                // alert(req.responseText);
                status_id.innerHTML = req.responseText;
                // status_id.innerHTML = 'Received';
            } else {
                console.log("data failed");
                status_id.innerHTML = 'An error occurred during your request: ' +  req.status + ' ' + req.statusText;
            }
            
        }  
    }

    
}

// function sent_request_to_php() {
    
// }
