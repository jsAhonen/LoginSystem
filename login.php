<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <form id="login-form" action="includes/login.inc.php" method="POST">
        <h1>Login</h1>
        <label>Username </label><input name="uid" id="username" type="text" required>
        <br>
        <label>Password </label><input name="pwd" id="password" type="password" required>
        <br>
        <input name="submit" type="submit" value="Login">
    </form>
    <br>
    <form action='includes/logout.inc.php' method='POST'>
        <input type='submit' name='submit' value='Logout'>
    </form>
    <br>
    <a href="signup.php"><button id="go-to-signup">Sign Up!</button></a>
    <script src="js/jquery-3.3.1.min.js"></script>
    <!--<script src="js/login-script.js"></script>-->
</body>

</html>