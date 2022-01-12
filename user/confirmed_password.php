<?php
	include("../connection/connection.php");
	$error = "";

	session_start();

	if (!isset($_SESSION['loggedin'])) {
        header('Location: ../error_messages/not_logged_in.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmare Parolă Nouă.</title>
    <link rel="stylesheet" href="confirmed.css"/>
</head>
<body>
    <?php require_once ("../shared_files/header.php");?>

    <div class="center-form">
        <div class="form-section">
            <h2> Parola a fost schimbată cu succes. <br> Acum va trebui să te autentifici cu noua parolă. </h2>
            </br>
            <button class="dark-button" onclick="window.location.href='../log_out/log_out.php'">Ok</button>
        </div>
    </div>

    <?php require_once("../shared_files/footer.php")?>
</body>
</html>