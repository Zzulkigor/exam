<?php
    require "conn.php";
    session_start();

    if(!isset($_SESSION['user_id'])){
        header("Location: auth.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `applications` WHERE `user_id` = '$user_id'";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Мои заявки</h1> 
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Описание проблемы</th>
            <th>Дата бронирования</th>
            <th>Время бронирования</th>
            <th>Статус</th>
        </tr>
        <?php
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>". $row['id']."</td>";
                    echo "<td>". $row['problem_description']."</td>";
                    echo "<td>". $row['booking_date']."</td>";
                    echo "<td>". $row['booking_time']."</td>";
                    echo "<td>". $row['status']."</td>";
                    echo "</tr>";
                }
            }else{
                echo '<tr><td colspan="5">Нет заявок</td></tr>';
            }
        ?>
    </table>
    <a href="create_application.php">Создать новую заявку</a><br>
    <a href="index.php">На главную</a>
</body>
</html>