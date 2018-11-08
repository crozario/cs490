<?php
    include_once("scripts/helper.php");
    session_start();
    check_session("student");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Instructor Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/style.css" />
    <script src="scripts/main.js"></script>

</head>

<body>
    <div class="nav-bar-container">
        <ul class="nav-bar">
            <li><a href="studenthome.php">Home</a></li>
        </ul>

    </div>
</body>

</html>