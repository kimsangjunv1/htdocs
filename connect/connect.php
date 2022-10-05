<?php
    $host = "localhost";
    $user = "root";
    $pass = "root";
    $db = "phpClass";
    $connect = new mysqli($host, $user, $pass, $db);
    $connect -> set_charset("utf8");
?>