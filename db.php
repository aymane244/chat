<?php
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = "chat";
    $conn = new mysqli($server, $user, $password, $dbname);
    if(!$conn){
        die. "Connection failed". mysqli_connect_error($conn);
    }
?>