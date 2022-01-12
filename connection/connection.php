<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'agro_student_market';
    $conn = new mysqli($hostname, $username, $password, $database);

    if(mysqli_connect_errno()) {
        echo 'Nu se poate connecta la baza de date.';
        exit();
    }
?>