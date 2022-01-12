<?php
	include("../connection/connection.php");
	$error = "";

	session_start();

	if (!isset($_SESSION['loggedin'])) {
        header('Location: ../error_messages/not_logged_in.php');
        exit;
    }

	$user_id=$_SESSION['id'];
	
	if(isset($_POST['submit']))
	{		
		$product_name=htmlentities($_POST['product_name'], ENT_QUOTES);
		$product_detail=htmlentities($_POST['product_detail'], ENT_QUOTES);
		$product_price=htmlentities($_POST['product_price'], ENT_QUOTES);
		$available_quantity=htmlentities($_POST['available_quantity'], ENT_QUOTES);
		$product_img=htmlentities($_POST['product_img'], ENT_QUOTES);
		$category_id=htmlentities($_POST['category_id'], ENT_QUOTES);
		
		$sql = "INSERT INTO products(user_id, product_name, product_detail, product_price, available_quantity, product_img, category_id) VALUES (?,?,?,?,?,?,?)";
		if($stmt = $conn -> prepare($sql))
		{
			$stmt->bind_param("issdisi", $user_id, $product_name, $product_detail, $product_price, $available_quantity, $product_img, $category_id);
			$stmt->execute();
			$stmt->close();
			header('location: ../user/my_products.php');
		}
		else
		{
			echo "</br>ERROR: Nu se poate insera produsul!";
		}
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html>
		<head>
			<title>Încarcă un produs</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<link rel="stylesheet" href="create_product.css"/>
		</head>

		<body>
			<?php include_once("../shared_files/header.php");?>
			
			<div class="center-form">
				<div class="form-section">
					<h1 class="titles">Încarcă un produs:</h1>
						<form action="" method="post">
							<div class="form">
								<div class="form-section-1">
									<label for="product_name" class="labels">Denumire produs:</label> </br>
									<input class="fields" type="text" name="product_name" placeholder="Introduceți denumirea produsului" required/> </br>

									</br>
										
									<label for="product_detail" class="labels">Descriere:</label> </br>
									<input class="fields" type="text" name="product_detail" placeholder="Introduceți detalii despre produs" required/> </br>

									</br>
										
									<label for="product_price" class="labels">Preț (RON):</label> </br>
									<input class="fields" type="number" min="0" step=".01" name="product_price" placeholder="Introduceți prețul produsului" required/>
								</div>
								<div class="form-section-2">
									<label for="available_quantity" class="labels">Cantitate disponibilă (buc.):</label> </br>
									<input class="fields" type="number" name="available_quantity" placeholder="Introduceți cantitatea" required/> </br>

									</br>
										
									<label for="product_img" class="labels">Încarcă imaginea:</label> </br>
									<input class="fields" type="text" name="product_img" placeholder="Introduceți url imagine" required/> </br>

									</br>
										
									<label class="labels">Categorie produs:</label> </br>
									<div>
										<?php
											$selectFromCategories = "SELECT category_name, category_id FROM categories GROUP BY category_name";
											$result = $conn->query($selectFromCategories);
											if ($result->num_rows>0) {
												echo '<select name="category_id" class="dropdown" required>';
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
								</div>
							</div>
							<div class="buttons">	
								<input class="dark-button" type="submit" name="submit" value="Adaugă Produs"/>
							</div>
						</form>
					<?php $conn->close(); ?>
					</br>

					<div class="links">
						<a href="../products_store/products_store.php">Înapoi la Magazin</a></br>
						<a href="../user/welcome.php">Înapoi la Utilizator</a>
					</div>
				</div>
			</div>
			
			<?php include_once("../shared_files/footer.php");?>
		</body>
	</html>