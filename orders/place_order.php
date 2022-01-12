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
        $first_name=htmlentities($_POST['first_name'], ENT_QUOTES);
		$last_name=htmlentities($_POST['last_name'], ENT_QUOTES);
        $email=htmlentities($_POST['email'], ENT_QUOTES);
		$destination_address=htmlentities($_POST['destination_address'], ENT_QUOTES);
		$contact_client=htmlentities($_POST['contact_client'], ENT_QUOTES);

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			exit('Adresă de email nu este validă!');
		}
		
		if(strlen($_POST['contact_client']) !== 10) {
			exit('Număr de telefon invalid.');
		}

		if($first_name=="" || $last_name=="" || $email=="" || $destination_address=="" || $contact_client=="")
        {
			$error='ERROR: Câmpuri goale!';
		} else {
                $sql = "INSERT INTO orders(user_id, id_cart, id_product, first_name, last_name, email, destination_address, order_status, contact_client) VALUES (?,?,?,?,?,?,?,?,?,?)";    
                if ($stmt = $conn->prepare($sql))
                    {
                        $stmt->bind_param("iiisssssi", $user_id, $id_cart, $id_product, $first_name, $last_name, $email, $destination_address, $order_status, $contact_client);
                        $stmt->execute();
                        $stmt->close();
                    } else {
                        echo "ERROR: Nu se poate executa update.";
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
    <title>Confirmă datele de livrare</title>
    <link rel="stylesheet" href="place_order.css"/>
</head>
<body>
    <?php include_once("../shared_files/header.php");?>
    
    <div class="center-form">
        <div class="form-section">
			<h1 class="titles">Confirmă datele pentru livrare</h1> </br>  
            <form action="" method="post">
            <div class="form">
                <?php
                    if ($user_id != '') {
                ?>
                        <?php
                            if ($result = $conn->query("SELECT * FROM users where user_id='".$user_id."'")) {
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_object();
                        ?>
                                 
                        <label for="first_name" class="labels">Nume:</label> </br>
                        <input class="fields" type="text" name="first_name" value="<?php echo $row->first_name; ?>" required/><br/>

                        </br>
                                
                        <label for="last_name" class="labels">Prenume:</label> </br>
                        <input class="fields" type="text" name="last_name" value="<?php echo $row->last_name; ?>" required/><br/>

                        </br>
                                
                        <label for="email" class="labels">Email:</label> </br>
                        <input class="fields" type="text" name="email" value="<?php echo $row->email; ?>" required/></br>
                                
                        </br>

						<label for="destination_address" class="labels">Adresa livrării:</label> </br>
                        <input class="fields" type="text" name="destination_address"  value="<?php echo $row->address; ?>" required/><br/>

                        </br>

                        <label for="contact_client" class="labels">Număr de telefon:</label> </br>
                        <div class="phone_number">
                            <p> +40 </p> <input class="fields phone" type="text" name="contact_client"  value="<?php echo $row->contact; ?>" required/><br/>
                        </div>
                        </br>
                        <?php
                                    }
                                }
                            }
                        ?>  
                    </br>
            </div>

            <div class="links">
                <input class="dark-button" type="submit" name="submit" value="Comandă" /> </br>
                </br>
                <a href="../shopping_cart/cart.php">Înapoi la coș</a></br>
                <a href="../products_store/products_store.php">Înapoi la Magazin</a></br>
            </div>
            </form>
        </div>
        </div>
        <?php include_once("../shared_files/footer.php");?>
</body>
</html>