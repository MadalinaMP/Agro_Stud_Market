<?php session_start(); ?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Autentificare</title>
            <link rel="stylesheet" href="log_in.css?version=1"/>
        </head>
        
        <body>
            <?php include_once("../shared_files/header.php");?>

            <div class="center-form">
                <div class="form-section">
                    <h1 class="titles">Autentificare</h1>
                    <div class="form">
                        <form action="log_in.php" method="post">
                            <label for="username" class="labels"> Nume de utilizator: </label> </br>
                            <input class="fields" type="text" name="username" placeholder="Introduceți numele de utilizator" id="username" required> </br>
                        
                            </br>
                        
                            <label for="password" class="labels"> Parolă: </label> </br>
                            <input class="fields" type="password" name="password" placeholder="Introduceți parola" id="password" required> </br>
                        
                            </br>
                        
                            <input type="submit" value="Autentificare" class="dark-button">
                        </form>
                    </div>
                    </br>

                    <div class="links">
                        <a href="../register_page/register_page.php">Nu ai cont? Înregistrează-te aici.</a><br>
                        <a href="../index.php">Acasă</a>
                    </div>
                </div>
            </div>
            
            <?php include_once("../shared_files/footer.php");?>
        </body>
    </html>