<?php
    session_start();
    include_once("admin_connection.php");

    if ($stmt = $admin_conn->prepare('SELECT admin_id, admin_password FROM admin WHERE admin_name = ?')) {
        $stmt->bind_param('s', $_POST['admin_name']);
        $stmt->execute();
        $stmt->store_result();
            
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($admin_id, $admin_password);
            $stmt->fetch();

            if ($admin_password) {
                session_regenerate_id();
                $_SESSION['admin_loggedin'] = TRUE;
                $_SESSION['adminname'] = $_POST['admin_name'];
                $_SESSION['adminid'] = $admin_id;
                header('Location: admin_welcome.php');
            } else {
                echo 'Nume admin sau parolă incorecte.';
            }
        } else {
            echo 'Nume admin sau parolă incorecte.';
        }

        $stmt->close();
    }
?>