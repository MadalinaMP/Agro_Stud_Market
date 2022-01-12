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
    $order_id=$_GET['order_id'];

    if(isset($_POST['submit']))
	{
        $first_name=htmlentities($_POST['first_name'], ENT_QUOTES);
		$last_name=htmlentities($_POST['last_name'], ENT_QUOTES);
		$email=htmlentities($_POST['email'], ENT_QUOTES);
		$destination_address=htmlentities($_POST['destination_address'], ENT_QUOTES);
        $contact_client=htmlentities($_POST['contact_client'], ENT_QUOTES);
        $order_status=htmlentities($_POST['order_status'], ENT_QUOTES);

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			exit('Adresa de email nu este validă!');
		}
		
		if(strlen($_POST['contact_client']) !==10) {
			exit('Număr de telefon invalid.');
		}

        $sql = "UPDATE orders SET first_name=?, last_name=?, email=?, destination_address=?, contact_client=?, order_status=? WHERE order_id='".$order_id."'";    
        if ($stmt = $admin_conn->prepare($sql))
        {
            $stmt->bind_param("ssssis", $first_name, $last_name, $email, $destination_address, $contact_client, $order_status);
            $stmt->execute();
            $stmt->close();
            header('location: orders_table.php');
        } else {
            echo "ERROR: Nu se poate executa update.";
        }
    }
?>

<html>
    <head>
        <title>Editează Comanda - Admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="../shared_files/update_create_item.css"/>
    </head>
    
    <body>
        <?php include_once("../shared_files/admin_header.php");?>
        
        <div class="center-form">
			<h1 class="titles">Editează Comanda</h1> </br>
                
            <form action="" method="post">
                <?php
                    if ($_GET['order_id'] != '') {
                ?>
                        <?php
                            if ($result = $admin_conn->query("SELECT * FROM orders where order_id='".$_GET['order_id']."'")) {
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
                           
						<label for="destination_address" class="labels">Adresă livrare:</label> </br>
                        <input class="fields" type="text" name="destination_address"  value="<?php echo $row->destination_address; ?>" required/><br/>

                        </br>

                        <label for="contact_client" class="labels">Număr de telefon client:</label> </br>
                        <input class="fields" type="text" name="contact_client"  value="<?php echo $row->contact_client; ?>" required/><br/>

                        </br>

                        <label for="order_status" class="labels">Status comandă:</label> </br>
                        <select class="fields" name="order_status" required>
  							<option>Înregistrată</option>
  							<option>În curs de expediere</option>
  							<option>Expediată</option>
  							<option>Anulată</option>
						</select>
                        <?php
                                    }
                                }
                            }
                        ?>  
                    </br>
                        <input class="submit_button" type="submit" name="submit" value="Modifică comanda" />
            </form>
            <a href="orders_table.php">Înapoi la tabela 'orders'</a>
        </div>
        <?php include_once("../shared_files/log_out_icon.php");?>
    </body>
</html>