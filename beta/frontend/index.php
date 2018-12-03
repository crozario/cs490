<?php
session_start();
include_once("scripts/helper.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Authentication</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/style.css"/>
    <script src="scripts/main.js"></script>  

</head>
    <body id="take-exam-body" onload="index_onload(); return false;">
        <div>
            <form id="login-form" method="POST" onsubmit="login_button_pressed(); return false;">
                <h2>Sign In</h2>
                <div class="login-form-container">
                    <label for="username"><b>Username</b></label>
                    <input class="login-input-username" type="text" placeholder="Enter Username" name="username" required>
                    <label for="password"><b>Password</b></label>
                    <input class="login-input-password" type="password" placeholder="Enter Password" name="password" required>
                  <button class="login-button" type="submit">Login</button>
                </div>   

                <div id="status"><strong>Incorrect username or password<strong></div>    
            </form>
        </div>
       
    </body>
</html>

