<?php session_start(); ?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Înregistrare</title>
            <link rel="stylesheet" href="register.css?version=1"/>
        </head>
        
        <body>
            <?php include_once("../shared_files/header.php");?>

            <div class="center-form">
                <div class="form-section">
                    <h1 class="titles">Înregistrează-te aici!</h1>
                    <div class="form">
                        <form action="register.php" method="post" autocomplete="off">
                            <label for="first_name" class="labels"> Nume: </label> </br>
                            <input class="fields" type="text" name="first_name" placeholder="Introduceți numele" id="first_name" required> </br>

                            </br>
                            
                            <label for="last_name" class="labels"> Prenume: </label> </br>
                            <input class="fields" type="text" name="last_name" placeholder="Introduceți prenumele" id="last_name" required> </br>

                            </br>
                            
                            <label for="address" class="labels"> Adresa: </label> </br>
                            <input class="fields" type="text" name="address" placeholder="Introduceți adresa" id="address" required> </br>

                            </br>

                            <label for="contact" class="labels"> Numar de teleon: </label> </br>
                            <div class="phone_number">
                                <p> +40 </p> <input class="fields phone" type="text" name="contact" placeholder="Introduceți numărul de telefon" id="contact" required> </br>
                            </div>
                            </br>
                            
                            <label for="username" class="labels"> Nume de utilizator: </label> </br>
                            <input class="fields" type="text" name="username" placeholder="Alegeți un nume de utilizator" id="username" required> </br>

                            </br>

                            <label for="email" class="labels"> Adresa de e-mail: </label> </br>
                            <input class="fields" type="email" name="email" placeholder="Introduceți adresa de email" id="email" required> </br>

                            </br>

                            <label for="password" class="labels"> Parolă: </label> </br>
                            <input class="fields" type="password" name="password" placeholder="Introduceți o parola" id="password" required> </br>
                            
                            </br>

                            <input class="dark-button" type="submit" value="Înregistrază-te">
                        </form>
                    </div>
                    </br>

                    <div class="links">
                        <a href="../log_in_page/log_in_page.php">Ai deja cont? Autentifică-te aici.</a><br>
                        <a href="../index.php">Acasă</a>
                    </div>
                </div>
            </div>
            
            <?php include_once("../shared_files/footer.php");?>
        </body>
    </html>