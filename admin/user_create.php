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
		$username=htmlentities($_POST['username'], ENT_QUOTES);
		$email=htmlentities($_POST['email'], ENT_QUOTES);
		$contact=htmlentities($_POST['contact'], ENT_QUOTES);
		$first_name=htmlentities($_POST['first_name'], ENT_QUOTES);
		$last_name=htmlentities($_POST['last_name'], ENT_QUOTES);
		$address=htmlentities($_POST['address'], ENT_QUOTES);
		$password=htmlentities($_POST['password'], ENT_QUOTES);

		if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
			exit('Numele de utilizator nu este valid!');
		}

		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			exit('Adresă de email nu este validă!');
		}
		
		if(strlen($_POST['contact']) !== 9) {
			exit('Număr de telefon invalid.');
		}
		
		if ($stmt = $admin_conn->prepare('SELECT user_id, password FROM users WHERE username = ?'))
		{
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			$stmt->store_result();
		}       
		
		if ($stmt->num_rows > 0)
		{
			echo 'Acest nume de utilizator există deja. Vă rugăm alegeți altul.';
		} else {
			$sql = "INSERT INTO users(username, email, contact, first_name, last_name, address, password) VALUES (?,?,?,?,?,?,?)";
			if($stmt = $admin_conn -> prepare($sql))
			{
				$password = password_hash($password, PASSWORD_DEFAULT);
				$stmt->bind_param("ssissss", $username, $email, $contact, $first_name, $last_name, $address, $password);
				$stmt->execute();
				$stmt->close();
				header('location: users_table.php');
			} else {
				echo "</br>ERROR: Nu se poate executa insert!";
			}
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
						<label for="username" class="labels">Username:</label> </br>
						<input class="fields" type="text" name="username" placeholder="Introduceți un username" required/> </br>

						</br>
										
						<label for="email" class="labels">Email:</label> </br>
						<input class="fields" type="text" name="email" placeholder="Introduceți un email" required/> </br>

						</br>

						<label for="password" class="labels">Parolă:</label> </br>
						<input class="fields" type="password" name="password" placeholder="Alegeți o parolă" required/> </br>

						</br>
										
						<label for="contact" class="labels">Număr de telefon:</label> </br>
						<div class="phone_number">
							<p> +40 </p><input class="fields" type="text" name="contact" placeholder="Introduceți numărul de telefon" required/> </br>
						</div>	
                        </br>
							
						<label for="first_name" class="labels">Nume:</label> </br>
						<input class="fields" type="text" name="first_name" placeholder="Introduceți numele" required/> </br>

						</br>
										
						<label for="last_name" class="labels">Prenume:</label> </br>
						<input class="fields" type="text" name="last_name" placeholder="Introduceți prenumele" required/> </br>

						</br>
									
						<label for="address" class="labels">Adresa:</label> </br>
						<input class="fields" type="text" name="address" placeholder="Introduceți adresa" required/> </br>
                        
                        </br>
                                
					    <input class="submit_button" type="submit" name="submit" value="Adaugă Utilizator"/>
					</form>
					<?php $admin_conn->close(); ?>
					</br>
                    <a href="users_table.php">Înapoi la tabela 'users'</a>
			</div>
			<?php include_once("../shared_files/log_out_icon.php");?>
		</body>
	</html>