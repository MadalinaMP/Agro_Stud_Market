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
		$product_name=htmlentities($_POST['product_name'], ENT_QUOTES);
		$product_detail=htmlentities($_POST['product_detail'], ENT_QUOTES);
		$product_price=htmlentities($_POST['product_price'], ENT_QUOTES);
		$available_quantity=htmlentities($_POST['available_quantity'], ENT_QUOTES);
		$product_img=htmlentities($_POST['product_img'], ENT_QUOTES);
		$category_id=htmlentities($_POST['category_id'], ENT_QUOTES);
		
		$sql = "INSERT INTO products(admin_id, product_name, product_detail, product_price, available_quantity, product_img, category_id) VALUES (?,?,?,?,?,?,?)";
		if($stmt = $admin_conn -> prepare($sql))
		{
			$stmt->bind_param("issdisi", $admin_id, $product_name, $product_detail, $product_price, $available_quantity, $product_img, $category_id);
			$stmt->execute();
			$stmt->close();
			header('location: products_table.php');
		} else {
			echo "</br>ERROR: Nu se poate executa insert!";
		}
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html>
		<head>
			<title>Încarcă un produs - Admin</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<link rel="stylesheet" href="../shared_files/update_create_item.css"/>
		</head>

		<body>
			<?php include_once("../shared_files/admin_header.php");?>
			
			<div class="center-form">
				<h1 class="titles">Încarcă un produs:</h1> </br>
					<form action="" method="post">
						<label for="product_name" class="labels">Denumire produs:</label> </br>
						<input class="fields" type="text" name="product_name" placeholder="Introduceți denumirea produsului" required/> </br>

						</br>
										
						<label for="product_detail" class="labels">Descriere:</label> </br>
						<input class="fields" type="text" name="product_detail" placeholder="Introduceți detalii despre produs" required/> </br>

						</br>
										
						<label for="product_price" class="labels">Pret (RON):</label> </br>
						<input class="fields" type="number" min="0" step=".01" name="product_price" placeholder="Introduceți prețul produsului" required/> </br>
								
                        </br>
							
						<label for="available_quantity" class="labels">Cantitate disponibilă (buc.):</label> </br>
						<input class="fields" type="number" name="available_quantity" placeholder="Introduceți cantitatea" required/> </br>

						</br>
										
						<label for="product_img" class="labels">Imagine:</label> </br>
						<input class="fields" type="text" name="product_img" placeholder="Introduceți url imagine" required/> </br>

						</br>
									
						<label class="labels">Categorie produs:</label> </br>
						<div>
					        <?php
							    $selectFromCategories = "SELECT category_name, category_id FROM categories GROUP BY category_name";
								$result = $admin_conn->query($selectFromCategories);
								if ($result->num_rows>0) {
									echo '<select name="category_id" class="fields" required>';
									echo '<option value="">Alege Categorie</option>';

									while ($row=$result->fetch_assoc()){
										$category_name = $row['category_name'];
										$category_id = $row['category_id'];
										echo '<option value="' .$category_id. '">' .$category_name. '</option>';
									}
												
									echo '</select>';
									echo '</label>';
								}
								?>
						</div>
                        
                        </br>
                                
					    <input class="submit_button" type="submit" name="submit" value="Adaugă Produs"/>
					</form>
					<?php $admin_conn->close(); ?>
					</br>
                    <a href="products_table.php">Înapoi la tabela 'products'</a>
			</div>
			<?php include_once("../shared_files/log_out_icon.php");?>
		</body>
	</html>