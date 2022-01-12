<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="index.css"/>
    <link rel="stylesheet" href="./shared_files/reset_default.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="welcome_bar">
        <div>
        <?php
            session_start();

            if (!isset($_SESSION['loggedin'])) {
                echo '<img class="user" src="icons/user.png"/>';
                echo "Neautentificat. <a href=\"log_in_page/log_in_page.php\">Intră în cont.</a>";
            } else {
                echo '<img class="user-logged" src="icons/user.png"/>';
                echo "<p>Bine ai venit, <strong>".$_SESSION['name']."</strong>. <a href=\"log_out/log_out.php\">Deconectare.</a></p>";
            }
        ?>
        </div>
        <div>
            <a class="admin" href="admin/admin_log_in_page.php" target="_blank"> Administrare </a>
        </div>
    </div>
    <div class="home-container">
        <div class="background">
            <div>
                <img id="logo" src="./icons/logo.png" />
            </div>
            <div id="home-buttons">
                <a href="./products_store/products_store.php"><input class="home-buttons" type="button" value="Magazin"/></a> </br>
                <a href="./log_in_page/log_in_page.php"> <input class="home-buttons" type="button" value="Autentificare"/> </a> </br>
                <a href="./register_page/register_page.php"> <input class="home-buttons" type="button" value="Inregistrare"/> </a> </br>
                <a href="./about/about.pdf" target="_blank"> <input class="home-buttons" type="button" value="Detalii"/> </a>
            </div>
        </div>
    </div>
</body>
</html>