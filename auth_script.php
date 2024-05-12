<?php
    require "conn.php";
    session_start();

    $login = $_POST['login'];
    $password = $_POST['password'];

    if($login === 'newfit' && $password === 'qsw123'){
        $_SESSION['admin'] = true;
        header("Location: admin_panel.php");
        exit();
    }

    $check_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `login` = '$login'");
    $user = mysqli_fetch_assoc($check_user);

    if($user){
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['fio'] = $user['fio'];
            header("Location: index.php");
            exit();
        } else{
            $_SESSION['error'] = "Неверный пароль!";
        }
    } else{
        $_SESSION['error'] = "Неверный логин или пароль";
    }
    header("Location: auth.php")
?>