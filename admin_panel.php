<?php
    require "conn.php";
    session_start();

    if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true){
        header("Location: auth.php");
        exit();
    }

    $sql_app = "SELECT a.*, u.fio, u.phone FROM `applications` a JOIN `users` u ON a.id = u.id";
    $result_app = mysqli_query($conn, $sql_app);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Панель администратора</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Панель администратора</h2>
    <a href="logout.php">Выйти</a>
    <br><br>
    <table>
        <tr>
            <th>ФИО</th>
            <th>Телефон</th>
            <th>Дата и время бронирования</th>
            <th>Машина</th>
            <th>Описание проблемы</th>
            <th>Статус</th>
            <th>Изменить статус</th>
        </tr>

        <?php
            if($result_app === false){
                echo "Ошибка выполнения: " . mysqli_error($conn);
            } else{
                if(mysqli_num_rows($result_app) > 0){
                    while($row = mysqli_fetch_assoc($result_app)){
                        echo "<tr>";
                        echo "<td>" . $row['fio'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['booking_date'] . "</td>";
                        echo "<td>" . $row['car_id'] . "</td>";
                        echo "<td>" . $row['problem_description'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        
                        if($row['status'] === 'новое'){
                            echo "<td><a href='change_status.php?id=".$row['id'] . "'>Изменить статус</a></td>";
                        } else{
                            echo "<td>...</td>";
                        }
                        echo "</tr>";
                    }
                }
            }
        ?>

    </table>
</body>
</html>
