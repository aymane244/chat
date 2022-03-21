<?php
    session_start();
    include("db.php");
    @$id = $_GET['Id'];
    $sql = "DELETE FROM `messages` WHERE id='$id'";
    mysqli_query($conn, $sql);
    header("location:timeline");
?>