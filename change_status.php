<?php
    session_start();
    require "conn.php";

    if(!isset($_SESSION['admin']) && $_SESSION['admin'] != true){
        header("Location: auth.php");
        exit();
    }

    $appl_id = $_GET['id'];

    $sql_check_appl = "SELECT * FROM `applications` WHERE `id` = '$appl_id'";
    $res_check_appl = mysqli_query($conn, $sql_check_appl);

    if(mysqli_num_rows($res_check_appl) === 0){
        $_SESSION['error'] = "Заявка с указанным идентификатором не найдена";
        header("Location: admin_panel.php");
        exit();
    }

    $row = mysqli_fetch_assoc($res_check_appl);
    $current_status = $row['status'];

    if($current_status != 'новое'){
        $_SESSION['error'] = "Нельзя изменить статус заявки с текущем '$current_status'";
        exit();
    }

    $sql_update_status = "UPDATE `applications` SET `status`='подтверждено' WHERE `id`='$appl_id'";
    if(mysqli_query($conn, $sql_update_status)){
        header("Location: admin_panel.php");
        exit();
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
?>