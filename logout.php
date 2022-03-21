<?php
    session_start();
    session_unset();
    session_destroy();
    setcookie("email", $rows['email'], time()-3600);
    setcookie("email", $rows['password'], time()-3600);
    header("location: index");
?>