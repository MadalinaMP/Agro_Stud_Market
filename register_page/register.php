<?php
    include_once("../connection/connection.php");
    
    if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
        exit(header('location: ../error_messages/wrong_password.php'));
    }

    if(strlen($_POST['contact']) !== 9) {
        exit(header('location: ../error_messages/invalid_phone_number.php'));
    }
    
    if ($stmt = $conn->prepare('SELECT user_id, password FROM users WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
    }       
    
    if ($stmt->num_rows > 0) {
        echo 'Acest nume de utilizator există deja. Vă rugăm alegeți altul.';
    } else {
        if ($stmt = $conn->prepare('INSERT INTO users (username, password, email, first_name, last_name, address, contact) VALUES (?, ?, ?, ?, ?, ?, ?)')) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('ssssssi', $_POST['username'], $password, $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['address'], $_POST['contact']);
            $stmt->execute();
            header('Location: ../log_in_page/log_in_page.php');
        } else {
            echo 'Nu se poate face prepare statement!';
        }
    }
    
    $stmt->close();
    $conn->close();
?>