<?php
    require_once "../connection/connection.php";
    require_once "../connection/functions.php";

    session_start();

    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../error_messages/not_logged_in.php');
        exit;
    }
    
    $user_id=$_SESSION['id'];

    if(isset($_POST['submit']))
	{
        $password=htmlentities($_POST['password'], ENT_QUOTES);
		$new_password=htmlentities($_POST['new_password'], ENT_QUOTES);

        if ($stmt = $conn->prepare('SELECT user_id, password FROM users WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();
                
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($user_id, $password);
                $stmt->fetch();
    
                if (password_verify($_POST['password'], $password)) {
                    $sql = "UPDATE users SET password=? WHERE user_id='".$user_id."'";    
                    if ($stmt = $conn->prepare($sql)) {
                        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $stmt->bind_param("s", $new_password);
                        $stmt->execute();
                        $stmt->close();
                        header('location: confirmed_password.php');
                    } else {
                        exit("Nu se poate schimba parola.");
                    }
                } else {
                    exit('Nume de utilizator sau parolă veche incorecte.');
                }
            } else {
                exit('Nume de utilizator sau parolă veche incorecte.');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schimbarea parolei</title>
    <link rel="stylesheet" href="change_password.css"/>
</head>
<body>
    <?php include_once("../shared_files/header.php");?>
    
    <div class="center-form">
        <div class="form-section">
			<h1 class="titles">Alege o parolă nouă</h1> </br>  
            <form action="" method="post">
            <div class="form">
                <?php
                    if ($_GET['user_id'] != '') {
                ?>
                        <?php
                            if ($result = $conn->query("SELECT * FROM users where user_id='".$_GET['user_id']."'")) {
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_object();
                        ?>
                        <label for="username" class="labels">Confirmă numele de utilizator:</label> </br>
                        <input class="fields" type="text" name="username" placehoder="Introduceți numele de utilizator" required/><br/>
                        </br>                
                        <label for="password" class="labels">Confirmă parola curentă:</label> </br>
                        <input class="fields" type="password" name="password" placehoder="Introduceți parola curentă" required/><br/>
                        </br>                
                        <label for="new_password" class="labels">Parolă nouă:</label> </br>
                        <input class="fields" type="password" name="new_password" placehoder="Introduceți parola nouă" required/><br/>
                        <?php
                                    }
                                }
                            }
                        ?>  
                    </br>
            </div>

            <div class="links">
                <input class="dark-button" type="submit" name="submit" value="Schimbă parola" /> </br>
                </br>
                </br>
                <a class="edit-links" href='edit_profile.php?user_id=<?php echo $_SESSION['id'] ?>'>Modifică-ti datele personale</a></br>
                </br>
                <a href="../user/my_products.php">Produsele Mele</a></br>
                <a href="../products_store/products_store.php">Înapoi la Magazin</a></br>
                <a href="../user/welcome.php">Înapoi la Utilizator</a></br>
            </div>
            </form>
        </div>
        </div>
        <?php include_once("../shared_files/footer.php");?>
</body>
</html>