<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Авторизация</title>
</head>
<body>
    <?php
        require "components/header.php";
    ?>

    <h3>Авторизация</h3>

    <form action="auth_script.php" method="post">
        <label for="login">Логин</label>
        <input type="text" name="login" placeholder="login">
        <label for="password">Пароль</label>
        <input type="password" name="password" placeholder="password">
        <button class="btn" type="submit">Войти</button>

        <?php
            if($_SESSION['error']){
                echo '<p class="error">'. $_SESSION['error'] . '</p>';
            }
            unset($_SESSION['error']);
        ?>
    </form>
</body>
</html>