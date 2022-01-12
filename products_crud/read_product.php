<?php
	require_once "../connection/functions.php";
	session_start();

	if (!isset($_SESSION['loggedin'])) {
        header('Location: ../error_messages/not_logged_in.php');
        exit;
    }

	$id_produs=$_GET['product_id'];
	$shoppingCart = new ShoppingCart();
	$user = new User();

	$product_array = $shoppingCart->getProductByID($id_produs);
?>	
<html>
    <head>
		<title>Detalii Produs</title>
        <link rel="stylesheet" type="text/css" href="read_product.css"/>
	</head>
	<body>
		<?php include_once("../shared_files/header.php");?>

		<?php		 
			if (! empty($product_array)) {
				foreach ($product_array as $key => $value) {
					if ($product_array[$key]["user_id"]==$_SESSION['id']) {
						$action = '../products_crud/update_product.php?product_id='.$product_array[$key]["product_id"].'';
					} else {
						$action = '../shopping_cart/cart.php?action=add&product_id='.$product_array[$key]["product_id"].'';
					}
		?>
		<div class="center-form">
			<div class="form-section">
				<form method="post" action="<?php echo $action; ?>">
				<div class="form">	
					<div>
						<img class="images" src="<?php echo $product_array[$key]["product_img"]; ?>" width="200" height="300">
					</div>
				
					</br>
					<div>
						<div class=top-section>
							<h2><?php echo $product_array[$key]["product_name"]; ?></h2>
							<p><?php echo "Preț: ".$product_array[$key]["product_price"]." <b>RON</b>"; ?></p>
						</div>
						<div class="seller-info">
						<?php
							if (isset($product_array[$key]["admin_id"])) {
								echo "Produs adăugat de Administrator.";
							} else {
								$query = "SELECT username, contact FROM users WHERE user_id='".$product_array[$key]["user_id"]."'";
								$user_array = $user -> getAllUsers($query);
								if (!empty($user_array)) {
									foreach ($user_array as $key => $value) {
									echo "<strong>Încărcat de: </strong>" . $user_array[$key]["username"] . "</br>";
									echo "<strong>Contact: </strong> +40 " . $user_array[$key]["contact"];
									}
								}
							}
						?>
						</div>
						<div class=center-section>
							<p><?php echo $product_array[$key]["product_detail"];?></p>	
						</div>
						<?php
							if ($product_array[$key]["user_id"]==$_SESSION['id']) {
        						$buttonText = "Modifică Produsul";
						?>
								<div class="bottom-section">
									<div>
										<p>Disponibil: <?php echo $product_array[$key]["available_quantity"]; ?> buc. </p>
									</div>
									<input class="dark-button" type="submit" value="Modifică Produsul"/><br>
								</div>
						<?php
    							} else {
						?>
								<div class="bottom-section">
								<div>
									<p>Disponibil: <?php echo $product_array[$key]["available_quantity"]; ?> buc. </p>
									<label for="quantity">Cantitate (buc.):</label>
									<input class="quantity" type="number" name="quantity" value="1" /><br>
								</div>
								<input class="dark-button" type="submit" value="Adaugă în coș"/><br>
						</div>
						<?php
    						}
						?>
					</div>
				</div>
				</form>
				<div class="links">
					<a href="../products_store/products_store.php">Înapoi la Magazin</a>
				</div>
			</div>
		</div>		 
		<?php
				}
			}
		?>
		<?php include_once("../shared_files/footer.php");?>
	</body>
</html>