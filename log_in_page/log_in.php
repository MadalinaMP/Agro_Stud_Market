<?php
    session_start();
    include_once("../connection/connection.php");

    if ($stmt = $conn->prepare('SELECT user_id, password FROM users WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
            
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $password);
            $stmt->fetch();

            if (password_verify($_POST['password'], $password)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $user_id;
                header('Location: ../user/welcome.php');
            } else {
                header('location: ../error_messages/failed_login.php');
            }
        } else {
            header('location: ../error_messages/failed_login.php');
        }
            
        $stmt->close();
    }
?>