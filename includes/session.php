<?php

session_start();

if (isset($_POST["firstname"])) {
    echo $_SESSION['u_first'];
    exit();
} elseif (isset($_POST["lastname"])) {
    echo $_SESSION['u_last'];
    exit();
} elseif (isset($_POST["email"])) {
    echo $_SESSION['u_email'];
    exit();
} elseif (isset($_POST["username"])) {
    echo $_SESSION['u_uid'];
    exit();
} elseif (isset($_POST["token"])) {
    echo $_SESSION['token_id'];
    exit();
} elseif (isset($_POST["token-time"])) {
    echo $_SESSION['token_time'];
    exit();
}

?>