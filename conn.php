<?php
    $conn = new mysqli('localhost', 'root', 'Lindemann_1995', 'ex');

    if($conn->connect_error){
        die('Connect failed: ' . $conn->connect_error);
    }
?>