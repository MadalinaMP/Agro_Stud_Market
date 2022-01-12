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

    if(isset($_POST['submit']))
	{		
		$first_name=htmlentities($_POST['first_name'], ENT_QUOTES);
		$last_name=htmlentities($_POST['last_name'], ENT_QUOTES);
		$email=htmlentities($_POST['email'], ENT_QUOTES);
		$destination_address=htmlentities($_POST['destination_address'], ENT_QUOTES);
        $contact_client=htmlentities($_POST['contact_client'], ENT_QUOTES);
        $order_status=htmlentities($_POST['order_status'], ENT_QUOTES);

		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			exit('Adresă de email nu este validă!');
		}
		
		if(strlen($_POST['contact_client']) !== 10) {
			exit('Număr de telefon invalid.');
		}
		
		$sql = "INSERT INTO orders(first_name, last_name, email, destination_address, contact_client, order_status) VALUES (?,?,?,?,?,?)";
		if($stmt = $admin_conn -> prepare($sql))
		{
			$stmt->bind_param("ssssis", $first_name, $last_name, $email, $destination_address, $contact_client, $order_status);
			$stmt->execute();
			$stmt->close();
			header('location: orders_table.php');
		} else {
			echo "</br>ERROR: Nu se poate executa insert!";
		}
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html>
		<head>
			<title>Încarcă un utilizator - Admin</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<link rel="stylesheet" href="../shared_files/update_create_item.css"/>
		</head>

		<body>
			<?php include_once("../shared_files/admin_header.php");?>
			
			<div class="center-form">
				<h1 class="titles">Încarcă un utilizator:</h1> </br>
					<form action="" method="post">
                    <label for="first_name" class="labels">Nume:</label> </br>
                        <input class="fields" type="text" name="first_name" placeholder="Introduceți numele" required/><br/>

                        </br>
                                
                        <label for="last_name" class="labels">Prenume:</label> </br>
                        <input class="fields" type="text" name="last_name" placeholder="Introduceți prenumele" required/><br/>

                        </br>
                                
                        <label for="email" class="labels">Email:</label> </br>
                        <input class="fields" type="text" name="email" placeholder="Introduceți email" required/></br>
                                
                        </br>
                           
						<label for="destination_address" class="labels">Adresă livrare:</label> </br>
                        <input class="fields" type="text" name="destination_address"  placeholder="Introduceți adresa livrării" required/><br/>

                        </br>

                        <label for="contact_client" class="labels">Număr de telefon client:</label> </br>
                        <input class="fields" type="text" name="contact_client"  placeholder="Introduceți numărul de telefon" required/><br/>

                        </br>

                        <label for="order_status" class="labels">Status comandă:</label> </br>
                        <select class="fields" name="order_status" required>
  							<option>Înregistrată</option>
  							<option>În curs de expediere</option>
  							<option>Expediată</option>
  							<option>Anulată</option>
						</select>
                        </br>
                                
					    <input class="submit_button" type="submit" name="submit" value="Adaugă Comanda"/>
					</form>
					<?php $admin_conn->close(); ?>
					</br>
                    <a href="orders_table.php">Înapoi la tabela 'orders'</a>
			</div>
			<?php include_once("../shared_files/log_out_icon.php");?>
		</body>
	</html>