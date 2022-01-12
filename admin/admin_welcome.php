<?php
    include("admin_connection.php");
    $error = "";

    session_start();

    if (!isset($_SESSION['admin_loggedin'])) {
        header('Location: restricted.php');
        exit;
    }

    $admin_id=$_SESSION['adminid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu</title>
    <link rel="stylesheet" href="admin_welcome.css"/>
</head>
<body>
    <div class="status-bar">
        <?php
            echo "Status: ";
            if (!isset($_SESSION['admin_loggedin'])) {
                echo "<img class=\"offline\" src=\"../icons/offline.png\"/>
                      <strong class=\"offline-status\">Offline</strong>.";
            } else {
                echo "<img class=\"online\" src=\"../icons/online.png\"/>
                      <strong class=\"online-status\">Online</strong>. • 
                      <a class=\"action\" href=\"admin_log_out.php\">Log out.</a> •
                      <a class=\"action\" href=\"admin_log_in_page.php\">Admin Log in</a>";
            }
        ?>
    </div>
    <div class="center">
        <h2> Agro Student Market - Admin Main Menu </h2>
        <h3> Selectați o tabelă de gestionat: </h3>
        <button class="table_buttons" onclick="window.location.href='categories_table.php'">categories</button>
        <button class="table_buttons" onclick="window.location.href='orders_table.php'">orders</button>
        <button class="table_buttons" onclick="window.location.href='products_table.php'">products</button>
        <button class="table_buttons" onclick="window.location.href='users_table.php'">users</button>

        <a href="admin_log_out.php"> Deconectare Admin </a>
    </div>
</body>
</html>