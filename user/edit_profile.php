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
		$username=htmlentities($_POST['username'], ENT_QUOTES);
		$email=htmlentities($_POST['email'], ENT_QUOTES);
		$contact=htmlentities($_POST['contact'], ENT_QUOTES);
		$first_name=htmlentities($_POST['first_name'], ENT_QUOTES);
		$last_name=htmlentities($_POST['last_name'], ENT_QUOTES);
		$address=htmlentities($_POST['address'], ENT_QUOTES);

        if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
			exit('Numele de utilizator nu este valid!');
		}
		
		if(strlen($_POST['contact']) !== 9) {
			exit(header('location: ../error_messages/invalid_phone_number.php'));
		}

        $sql = "UPDATE users SET username=?, email=?, contact=?, first_name=?, last_name=?, address=? WHERE user_id='".$user_id."'";    
        if ($stmt = $conn->prepare($sql))
        {
            $stmt->bind_param("ssisss", $username, $email, $contact, $first_name, $last_name, $address);
            $stmt->execute();
            $stmt->close();
            header('Location: confirmed_user_info.php');
        } else {
            echo "ERROR: Nu se poate executa update.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editează Date Personale</title>
    <link rel="stylesheet" href="edit_profile.css"/>
</head>
<body>
    <?php include_once("../shared_files/header.php");?>
    
    <div class="center-form">
        <div class="form-section">
			<h1 class="titles">Editează datele personale</h1> </br>  
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
                        <div class="form-section-1">                   
                        <label for="username" class="labels">Username:</label> </br>
                        <input class="fields" type="text" name="username" value="<?php echo $row->username; ?>" required/><br/>

                        </br>
                                
                        <label for="email" class="labels">Email:</label> </br>
                        <input class="fields" type="text" name="email" value="<?php echo $row->email; ?>" required/><br/>

                        </br>
                                
                        <label for="contact" class="labels">Număr de telefon:</label> </br>
                        <div class="phone_number">
                            <p> +40 </p> <input class="fields phone" type="text" name="contact" value="<?php echo $row->contact; ?>" required/></br>
                        </div>        
                        </br>
                        </div>

                        <div class="form-section-2">   
						<label for="first_name" class="labels">Nume:</label> </br>
                        <input class="fields" type="text" name="first_name"  value="<?php echo $row->first_name; ?>" required/><br/>

                        </br>

                        <label for="last_name" class="labels">Prenume:</label> </br>
                        <input class="fields" type="text" name="last_name"  value="<?php echo $row->last_name; ?>" required/><br/>

                        </br>

                        <label for="address" class="labels">Adresa:</label> </br>
						<input class="fields" type="text" name="address"  value="<?php echo $row->address; ?>" required/><br/> 
                        </div>
                        <?php
                                    }
                                }
                            }
                        ?>  
                    </br>
            </div>

            <div class="links">
                <input class="dark-button" type="submit" name="submit" value="Modifică-ți datele" /> </br>
                </br>
                <a class="edit-links" href='change_password.php?user_id=<?php echo $_SESSION['id'] ?>'>Schimbă parola</a></br></br>
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