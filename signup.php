<!DOCTYPE html>
<?php
echo "signup.php";
?>

    <html>

    <head>
        <title>Sign Up</title>
    </head>

    <body>
        <form id="signup-form" action="includes/signup.inc.php" method="POST">
            <h1>Sign up</h1>
            <label>First Name </label><input name="first" id="firstname" type="text" required>
            <br>
            <label>Last Name </label><input name="last" id="lastname" type="text" required>
            <br>
            <label>Email </label><input name="email" id="email" type="text" required>
            <br>
            <label>Username </label><input name="uid" id="new-username" type="text" required>
            <br>
            <label>Password </label><input name="pwd" id="new-password" type="password" required>
            <br>
            <input name="submit" type="submit" value="Sign Up">
            <a href="login.html"><button>To Login page</button></a>
        </form>
        <script src="js/jquery-3.3.1.min.js"></script>
        <!--<script src="js/signup-script.js"></script>-->
    </body>

    </html>