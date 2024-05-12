<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Профиль</title>
</head>
<body>
    <?php
        require "conn.php";
        session_start();

        if(isset($_SESSION['fio']) && isset($_SESSION['login'])){
            echo "ФИО: " . $_SESSION['fio'] . "<br>";
            echo "Логин: " . $_SESSION['login'] . "<br>";
        }
    ?>
</body>
</html>