<?php
    session_start();
    require "conn.php";

    if(!isset($_SESSION['user_id'])){
        header("Location: auth.php");
        exit();
    }

    $sql = "SELECT * FROM `cars`";
    $cars_res = mysqli_query($conn, $sql);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $car_id = $_POST['car_id'];
        $problem_description = $_POST['problem_description'];
        $booking_date = $_POST['booking_date'];
        $booking_time = $_POST['booking_time'];

        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO `applications` (`user_id`, `car_id`, `problem_description`, `booking_date`, `booking_time`) VALUES ('$user_id','$car_id','$problem_description','$booking_date','$booking_time')";
        if(mysqli_query($conn, $sql)){
            header("Location: applications.php");
            exit();
        } else{
            echo "Ошибка: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Новая заявка</h1>
    <form action="" method="post">
        <label for="car_id">Выберите автомобиль:</label>
        <select name="car_id" id="car_id" required>
            <?php
                while($row = mysqli_fetch_assoc($cars_res)){
                    echo '<option value="' . $row['car_id'] . '">'.$row['brand']. ' '.$row['model'] .'</option>';
                }
            ?>
        </select>
        <br>
        <label for="problem_description">Описание проблемы:</label>
        <textarea name="problem_description" id="problem_description" cols="30" rows="5" required></textarea>
        <br>
        <label for="booking_date">Дата бронирования:</label>
        <input type="date" name="booking_date" id="booking_date" required>
        <br>
        <label for="booking_time">Время бронирования (от 8:00 до 21:00):</label>
        <input type="time" name="booking_time" id="booking_time" min="08:00" max="21:00" required>
        <br>
        <button type="submit">Отправить заявку</button>
    </form>
</body>
</html>
