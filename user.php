<?php

session_start();

// VALIDATE THE USER
if ($_GET['tkn'] != $_SESSION['token_id'] || $_GET['uid'] != $_SESSION['u_uid']) {
    session_unset();
    session_destroy();
    header("Location: unauthorized.html");
}

// CHECK FOR SESSION TIMEOUT
if (((60 * 5) - (time() - $_SESSION['token_time'])) < 0) {
    session_unset();
    session_destroy();
    header("Location: timeout.html?timedifference=" . (time() - $_SESSION['token_time']));
} else {
    echo ((60 * 5) - (time() - $_SESSION['token_time']));
    //$_SESSION['token_time'] = time();
}

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
</head>

<body>
    <!--HEADING-->
    <div class="container">
        <header class="page-header">
            <h1>User Account</h1>
            <h3>Hello, <span id="insert-name"></span> :)</h3>
        </header>
    </div>
    <!--NAVBAR-->
    <div class="container">
        <div class="navbar navbar-header">
            <button id="to-account-info" class="btn navbar-btn btn-info">My Account Information</button>
            <button id="logout-button" class="btn navbar-btn btn-warning">Logout</button>
        </div>
    </div>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/user-script.js"></script>
</body>

</html>