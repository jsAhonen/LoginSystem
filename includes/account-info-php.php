<?php

session_start();

if (isset($_POST["firstname"])) {
    include 'dbh.inc.php';
    $uid = $_SESSION['u_uid'];
    $sql = "SELECT * FROM users WHERE user_uid='$uid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $row['user_first'];
    exit();
} elseif (isset($_POST["lastname"])) {
    include 'dbh.inc.php';
    $uid = $_SESSION['u_uid'];
    $sql = "SELECT * FROM users WHERE user_uid='$uid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $row['user_last'];
    exit();
} elseif (isset($_POST["email"])) {
    include 'dbh.inc.php';
    $uid = $_SESSION['u_uid'];
    $sql = "SELECT * FROM users WHERE user_uid='$uid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $row['user_email'];
    exit();
} elseif (isset($_POST["uid"])) {
    include 'dbh.inc.php';
    $uid = $_SESSION['u_uid'];
    $sql = "SELECT * FROM users WHERE user_uid='$uid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $row['user_uid'];
    exit();
}

?>