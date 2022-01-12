<?php
	include("admin_connection.php");
	include("admin_functions.php");
    $error = "";

    session_start();

    if (!isset($_SESSION['admin_loggedin'])) {
        header('Location: restricted.php');
        exit;
    }

    $admin_id=$_SESSION['adminid'];
    $user_id=$_GET['user_id'];

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

		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			exit('Adresă de email nu este validă!');
		}
		
		if(strlen($_POST['contact']) !== 9) {
			exit('Număr de telefon invalid.');
		}

        $sql = "UPDATE users SET username=?, email=?, contact=?, first_name=?, last_name=?, address=? WHERE user_id='".$user_id."'";    
        if ($stmt = $admin_conn->prepare($sql))
        {
            $stmt->bind_param("ssisss", $username, $email, $contact, $first_name, $last_name, $address);
            $stmt->execute();
            $stmt->close();
            header('location: users_table.php');
        } else {
            echo "ERROR: Nu se poate executa update.";
        }
    }
?>

<html>
    <head>
        <title>Editează Utilizatorul - Admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="../shared_files/update_create_item.css"/>
    </head>
    
    <body>
        <?php include_once("../shared_files/admin_header.php");?>
        
        <div class="center-form">
			<h1 class="titles">Editează Utilizatorul</h1> </br>
                
            <form action="" method="post">
                <?php
                    if ($_GET['user_id'] != '') {
                ?>
                        <?php
                            if ($result = $admin_conn->query("SELECT * FROM users where user_id='".$_GET['user_id']."'")) {
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_object();
                        ?>
                                           
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
                           
						<label for="first_name" class="labels">Nume:</label> </br>
                        <input class="fields" type="text" name="first_name"  value="<?php echo $row->first_name; ?>" required/><br/>

                        </br>

                        <label for="last_name" class="labels">Prenume:</label> </br>
                        <input class="fields" type="text" name="last_name"  value="<?php echo $row->last_name; ?>" required/><br/>

                        </br>

                        <label for="address" class="labels">Adresa:</label> </br>
						<input class="fields" type="text" name="address"  value="<?php echo $row->address; ?>" required/><br/> 
                        <?php
                                    }
                                }
                            }
                        ?>  
                    </br>
                        <input class="submit_button" type="submit" name="submit" value="Modifica utilizator" />
            </form>
            <a href="users_table.php">Inapoi la tabela 'products'</a>
        </div>
        <?php include_once("../shared_files/log_out_icon.php");?>
    </body>
</html>