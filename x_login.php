<?php
    session_start();
    
    $userinfo = array('Mike'=>'1234', 'Esther'=>'4321', 'Jared'=>'1324', 'Sonya'=>'2413');
    $token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (array_key_exists($username, $userinfo)) {
        if ($userinfo[$username] == $password) {
            echo $token;
        } else {
            echo "Login not successful.";
        }
    } else {
        echo "Login not successful.";
    }
?>