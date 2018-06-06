<?php

session_start();

// VALIDATE THE USER
if ($_GET['tkn'] != $_SESSION['token_id'] && $_GET['uid'] != $_SESSION['u_uid']) {
    session_unset();
    session_destroy();
    header("Location: unauthorized.html");
} elseif ($_GET['uid'] != $_SESSION['u_uid']) {
    session_unset();
    session_destroy();
    header("Location: unauthorized.html?username");
} elseif ($_GET['tkn'] != $_SESSION['token_id']) {
    session_unset();
    session_destroy();
    header("Location: unauthorized.html?token");
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

if (isset($_GET['error'])) {
    if ($_GET['error'] == "incorrect-pwd") {
        echo "<em>ERROR: That is not the current password!</em>";
    } elseif ($_GET['error'] == "no-match")  {
        echo "<em>ERROR: New passwords did not match!</em>";
    }
}

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap-3.3.7-dist/css/bootstrap-theme.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>My Account Info</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table-bordered table-responsive table-striped">
                    <tr>
                        <td class="text-center text-primary">First Name</td>
                        <td class="text-center" id="firstname-field"></td>
                        <td class="text-center"><button id="firstname-button"><span class="glyphicon glyphicon-pencil"></span></button></td>
                    </tr>
                    <tr>
                        <td class="text-center text-primary">Last Name</td>
                        <td class="text-center" id="lastname-field"></td>
                        <td class="text-center"><button id="lastname-button"><span class="glyphicon glyphicon-pencil"></span></button></td>
                    </tr>
                    <tr>
                        <td class="text-center text-primary">Email</td>
                        <td class="text-center" id="email-field"></td>
                        <td class="text-center"><button id="email-button"><span class="glyphicon glyphicon-pencil"></span></button></td>
                    </tr>
                    <tr>
                        <td class="text-center text-primary">Username</td>
                        <td class="text-center" id="uid-field"></td>
                        <td class="text-center"><button id="uid-button"><span class="glyphicon glyphicon-pencil"></span></button></td>
                    </tr>
                    <tr>
                        <td class="text-center text-primary">Password</td>
                        <td class="text-center" id="pwd-field">*******</td>
                        <td class="text-center"><button id="pwd-button"><span class="glyphicon glyphicon-pencil"></span></button></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button id="to-user-page-button" class="btn btn-info">User main page</button>
                <button id="logout-button" class="btn btn-warning" >Logout</button>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>
    <script src="js/account-info-script.js"></script>
    <?php echo "Time left: " . ((60*5) - (time() - $_SESSION['token_time']));?>
</body>

</html>