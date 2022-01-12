<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Autentificare Admin</title>
            <link rel="stylesheet" href="admin_log_in.css"/>
            <link rel="stylesheet" href="../shared_files/reset_default.css"/>
        </head>
        
        <body>
            <div class="status-bar">
                <?php
                    session_start();

                    echo "Status: ";
                    if (!isset($_SESSION['admin_loggedin'])) {
                        echo "<img class=\"offline\" src=\"../icons/offline.png\"/>
                              <strong class=\"offline-status\">Offline</strong>.";
                    } else {
                        echo "<img class=\"online\" src=\"../icons/online.png\"/>
                              <strong class=\"online-status\">Online</strong>. • 
                              <a class=\"action\" href=\"admin_log_out.php\">Log out.</a> • 
                              <a class=\"action\" href=\"admin_welcome.php\">Administrare BD</a>";
                    }
                ?>
            </div>
            <div class="centering">
                <div class="main-section">
                    <h2>Autentificare Admin</h2><br/>
                    <form action="admin_log_in.php" method="post">
                        <label for="admin_name"> Nume admin: </label> </br>
                        <input class="inputs" type="text" name="admin_name" placeholder="Introduceți numele adminului" id="admin_name" required> </br>
                        
                        </br>
                        
                        <label for="admin_password"> Parolă admin: </label> </br>
                        <input class="inputs" type="password" name="admin_password" placeholder="Introduceți parola adminului" id="admin_password" required> </br>
                        
                        </br>
                        
                        <input class="login_admin" type="submit" value="Autentificare">
                    </form>
                
                    </br>

                    <div><a href="../index.php">Acasă</a></div>
                </div>
            </div>
        </body>
    </html>