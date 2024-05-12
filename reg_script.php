<?php
    require "conn.php";
    session_start();

    $fio = $_POST['fio'];
    $phone = $_POST['phone'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    if(!preg_match("/^[а-яА-ЯёЁa-zA-Z\s]+$/u", $fio)){
        $_SESSION['error'] = "ФИО не соответствует требованиям";
        header("Location: reg.php");
        exit();
    }

    if(strlen($login) < 3){
        $_SESSION['error'] = "Длина логина минимум 3 символа";
        header("Location: reg.php");
        exit();
    }

    if(!preg_match('/[A-Z]/', $password)) {
        $_SESSION['error'] = "Пароль должен содержать хотя бы одну заглавную букву";
        header("Location: reg.php");
        exit();
    }
    if($password != $password_confirm){
        $_SESSION['error'] = "Пароли не совпадают";
        header("Location: reg.php");
        exit();
    }

    $sql_login = "SELECT * FROM `users` WHERE `login` = '$login'";
    $result_login = mysqli_query($conn, $sql_login);
    if(mysqli_num_rows($result_login) > 0){
        $_SESSION['error'] = "Логин уже занят!";
        header("Location: reg.php");
        exit();
    }

    $sql_login = "INSERT INTO `users` (`fio`, `phone`, `login`, `password`) VALUES ('$fio', '$phone', '$login', '$hashed_pass')";
    if(mysqli_query($conn, $sql_login)){
        header("Location: auth.php");
        exit();
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }


?>