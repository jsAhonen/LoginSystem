<?php

session_start();

// VALIDATE THE USER
if ($_GET['tkn'] != $_SESSION['token_id'] || $_GET['uid'] != $_SESSION['u_uid']) {
    /*session_unset();
    session_destroy();
    header("Location: ../unauthorized.html");*/
    echo "Get: " . $_GET['uid'] . $_GET['tkn'] . "Session: " . $_SESSION['u_uid'] . $_SESSION['token_id'];
}

// CHECK FOR SESSION TIMEOUT
if (((60 * 5) - (time() - $_SESSION['token_time'])) < 0) {
    session_unset();
    session_destroy();
    header("Location: timeout.html?timedifference=" . (time() - $_SESSION['token_time']));
} else {
    // echo ((60 * 5) - (time() - $_SESSION['token_time']));
    //$_SESSION['token_time'] = time();
}

    if ($_POST["name"] == "firstname") {
        include 'dbh.inc.php';
        $uid = mysqli_real_escape_string($conn, $_SESSION['u_uid']);
        $newFirstname = $_POST["value"];
        $sql = "UPDATE users SET user_first = '$newFirstname' WHERE user_uid='$uid';";
        $result = mysqli_query($conn, $sql);
        echo "account-info.php?uid=" . $_SESSION['u_uid'] . "&tkn=" . $_SESSION['token_id'] . "&tm=" . $_SESSION['token_time'];
        exit();
    } elseif ($_POST["name"] == "lastname") {
        include 'dbh.inc.php';
        $uid = mysqli_real_escape_string($conn, $_SESSION['u_uid']);
        $newLastname = $_POST["value"];
        $sql = "UPDATE users SET user_last = '$newLastname' WHERE user_uid='$uid';";
        $result = mysqli_query($conn, $sql);
        echo "account-info.php?uid=" . $_SESSION['u_uid'] . "&tkn=" . $_SESSION['token_id'] . "&tm=" . $_SESSION['token_time'];
        exit();
    } elseif ($_POST["name"] == "email") {
        include 'dbh.inc.php';
        $uid = mysqli_real_escape_string($conn, $_SESSION['u_uid']);
        $newEmail = $_POST["value"];
        $sqlA = "UPDATE users SET user_email = '$newEmail' WHERE user_uid='$uid';";
        $resultA = mysqli_query($conn, $sqlA);
        $sqlB = "SELECT * FROM users WHERE user_uid='$uid';";
        $resultB = mysqli_query($conn, $sqlB);
        $row = mysqli_fetch_assoc($resultB);
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
        echo "account-info.php?uid=" . $_SESSION['u_uid'] . "&tkn=" . $_SESSION['token_id'] . "&tm=" . $_SESSION['token_time'];
        exit();
    } elseif ($_POST["name"] == "username") {
        include 'dbh.inc.php';
        $uid = mysqli_real_escape_string($conn, $_SESSION['u_uid']);
        $newUsername = $_POST["value"];
        $sqlA = "UPDATE users SET user_uid = '$newUsername' WHERE user_uid='$uid';";
        $resultA = mysqli_query($conn, $sqlA);
        $sqlB = "SELECT * FROM users WHERE user_uid='$newUsername';";
        $resultB = mysqli_query($conn, $sqlB);
        $row = mysqli_fetch_assoc($resultB);
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
        echo "account-info.php?uid=" . $_SESSION['u_uid'] . "&tkn=" . $_SESSION['token_id'] . "&tm=" . $_SESSION['token_time'];
        exit();
    } elseif ($_POST["name"] == "password") {
        include 'dbh.inc.php';
        $uid = mysqli_real_escape_string($conn, $_SESSION['u_uid']);
        $sql = "SELECT * FROM users WHERE user_uid='$uid';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $currentPassword = $_POST["current_password"];
        $newPassword = $_POST["new_password"];
        $newPasswordConfirm = $_POST["confirm_password"];
        // VALIDATIONS
        $checkCurrentPwd = password_verify($currentPassword, $row['user_pwd']);
        if ($checkCurrentPwd == true) {
            if ($newPasswordConfirm == $newPassword) {
                $uid = mysqli_real_escape_string($conn, $_SESSION['u_uid']);
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET user_pwd = '$hashedNewPassword' WHERE user_uid='$uid';";
                $result = mysqli_query($conn, $sql);
                echo "account-info.php?uid=" . $_SESSION['u_uid'] . "&tkn=" . $_SESSION['token_id'] . "&tm=" . $_SESSION['token_time'];
                exit();
            } else {
                echo "account-info.php?uid=" . $_SESSION['u_uid'] . "&tkn=" . $_SESSION['token_id'] . "&tm=" . $_SESSION['token_time'] . "&error=no-match";
            }
        } else {
            echo "account-info.php?uid=" . $_SESSION['u_uid'] . "&tkn=" . $_SESSION['token_id'] . "&tm=" . $_SESSION['token_time'] . "&error=incorrect-pwd";
        }
        
    }

    
?>