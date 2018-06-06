<?php

session_start();

include 'dbh.inc.php';
$uid = $_GET['uid'];
$token = $_GET['tkn'];
$time = $_GET['tm'];
$rowTest = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE user_uid='$uid'"));
$usernameTest = $rowTest['user_uid'];
$emailTest = $rowTest['user_email'];
$tokenTest = hash('sha512', "isgood".$usernameTest.$emailTest);

if ($token != $tokenTest) {
    session_unset();
    session_destroy();
    header("Location: ../unauthorized.html");
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
            <button class="btn btn-info navbar-btn"><a href="account-info.html">My Account Information</a></button>
            <form action="includes/logout.inc.php" method="POST" id="logout-form"><input type="submit" name="submit" class="btn navbar-btn" value="Logout"></form>
        </div>
    </div>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/user-script.js"></script>
</body>

</html>