<?php

session_start();

// VALIDATE THE USER
if ($_GET['tkn'] != $_SESSION['token_id'] || $_GET['uid'] != $_SESSION['u_uid']) {
    session_unset();
    session_destroy();
    header("Location: ../unauthorized.html");
}

// CHECK FOR SESSION TIMEOUT
if ((60*5) - (time() - $_SESSION['token_time']) < 0) {
    session_unset();
    session_destroy();
    header("Location: timeout.html?timedifference=" . (time() - $_SESSION['token_time']));
} else {
    $_SESSION['token_time'] = time();
}

if (isset($_GET['nuid'])) {
    // SQL SELECT QUERY AND ARRAY
    include 'dbh.inc.php';
    $uid = $_GET['nuid'];
    $sql = "SELECT * FROM users WHERE user_uid='$uid';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // SESSION VARIABLE UPDATE
    $_SESSION['u_id'] = $row['user_id'];
    $_SESSION['u_first'] = $row['user_first'];
    $_SESSION['u_last'] = $row['user_last'];
    $_SESSION['u_email'] = $row['user_email'];
    $_SESSION['u_uid'] = $row['user_uid'];
    // CREATE A NEW SECURITY TOKEN
    $salt = "isgood";
    $_SESSION['token_id'] = hash('sha512', $salt.$_SESSION['u_uid'].$_SESSION['u_email']);
    $_SESSION['token_time'] = time();
    // GET VARIABLE UPDATE
    header("Location: ../account-info.php?uid=" . $_SESSION['u_uid'] . "&tkn=" . $_SESSION['token_id'] . "&tm=" . $_SESSION['token_time']);
} elseif (isset($_GET['nml'])) {
    // SQL SELECT QUERY AND ARRAY
    include 'dbh.inc.php';
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $sql = "SELECT * FROM users WHERE user_uid='$uid';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // SESSION VARIABLE UPDATE
    $_SESSION['u_id'] = $row['user_id'];
    $_SESSION['u_first'] = $row['user_first'];
    $_SESSION['u_last'] = $row['user_last'];
    $_SESSION['u_email'] = $row['user_email'];
    $_SESSION['u_uid'] = $row['user_uid'];
    // CREATE A NEW SECURITY TOKEN
    $salt = "isgood";
    $_SESSION['token_id'] = hash('sha512', $salt.$_SESSION['u_uid'].$_SESSION['u_email']);
    $_SESSION['token_time'] = time();
    // GET VARIABLE UPDATE
    header("Location: ../account-info.php?uid=" . $_SESSION['u_uid'] . "&tkn=" . $_SESSION['token_id'] . "&tm=" . $_SESSION['token_time']);
}
?>