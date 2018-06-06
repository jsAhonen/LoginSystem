<?php

session_start();

if (isset($_POST['submit'])) {
    include 'dbh.inc.php';

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    // Error handlers
    // Check if inputs are empty
    if (empty($uid) || empty($pwd)) {
        session_unset();
        session_destroy();
        header("Location: ../login.html?login=empty");
        exit();
    } else {
        // CHECK IF A USER WITH THE GIVEN USERNAME EXISTS
        $sql = "SELECT * FROM users WHERE user_uid='$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            session_unset();
            session_destroy();
            header("Location: ../login.html?login=error1");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                // CHECK IF THE PASSWORD IS VALID
                // de-hashing the password
                $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
                if ($hashedPwdCheck == false) {
                    session_unset();
                    session_destroy();
                    header("Location: ../login.html?login=error2");
                    exit();
                } elseif ($hashedPwdCheck == true) {
                    // LOG THE USER IN
                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_first'] = $row['user_first'];
                    $_SESSION['u_last'] = $row['user_last'];
                    $_SESSION['u_email'] = $row['user_email'];
                    $_SESSION['u_uid'] = $row['user_uid'];
                    // CREATE A SECURITY TOKEN
                    $salt = "isgood";
                    $_SESSION['token_id'] = hash('sha512', $salt.$_SESSION['u_uid'].$_SESSION['u_email']);
                    $_SESSION['token_time'] = time();
                    header("Location: ../user.php?uid=" . $_SESSION['u_uid'] . "&tkn=" . $_SESSION['token_id'] . "&tm=" . $_SESSION['token_time']);
                }
            }
        }
    }
} else {
    header("Location: ../login.html?login=error3");
    exit();
}

?>