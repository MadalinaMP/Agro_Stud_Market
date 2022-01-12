<?php
    session_start();
    unset($_SESSION["admin_loggedin"]);
    unset($_SESSION["adminid"]);

    header('Location: admin_log_in_page.php');
?>