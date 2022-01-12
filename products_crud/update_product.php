<?php 
    include("../connection/connection.php");
	$error = "";

	session_start();

	if (!isset($_SESSION['loggedin'])) {
        header('Location: ../error_messages/not_logged_in.php');
        exit;
    }

	$user_id=$_SESSION['id'];
    $product_id=$_GET['product_id'];

	if(isset($_POST['submit']))
	{
		$product_name=htmlentities($_POST['product_name'], ENT_QUOTES);
		$product_detail=htmlentities($_POST['product_detail'], ENT_QUOTES);
		$product_price=htmlentities($_POST['product_price'], ENT_QUOTES);
		$available_quantity=htmlentities($_POST['available_quantity'], ENT_QUOTES);
		$product_img=htmlentities($_POST['product_img'], ENT_QUOTES);
		$category_id=htmlentities($_POST['category_id'], ENT_QUOTES);

        $sql = "UPDATE products SET user_id=?, product_name=?, category_id=?, product_img=?, product_price=?, available_quantity=?, product_detail=? WHERE product_id='".$product_id."'";    
        if ($stmt = $conn->prepare($sql))
        {
            $stmt->bind_param("isisdis", $user_id, $product_name, $category_id, $product_img, $product_price, $available_quantity, $product_detail);
            $stmt->execute();
            $stmt->close();
            header('location: ../user/my_products.php');
        } else {
            echo "ERROR: Nu se poate executa update.";
        }
    }
?>

<html>
    <head>
        <title>Editează Produsul</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="update_product.css"/>
    </head>
    
    <body>
        <?php include_once("../shared_files/header.php");?>
        
        <div class="center-form">
			<div class="form-section">
				<h1 class="titles">Editează Produsul</h1>
                
                <form action="" method="post">
                    <div class="form">
                        <?php
                            if ($_GET['product_id'] != '') {
                        ?>
                                <?php
                                    if ($result = $conn->query("SELECT * FROM products where product_id='".$_GET['product_id']."'")) {
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_object();
                                ?>
                            <div class="form-section-1">                
                                <label for="product_name" class="labels">Denumire produs:</label> </br>
                                <input class="fields" type="text" name="product_name" value="<?php echo $row->product_name; ?>"/><br/>

                                </br>
                                
                                <label for="product_detail" class="labels">Descriere:</label> </br>
                                <input class="fields" type="text" name="product_detail" value="<?php echo $row->product_detail; ?>"/><br/>

                                </br>
                                
                                <label for="product_price" class="labels">Preț (RON):</label> </br>
                                <input class="fields" type="number" min="0" step=".01" name="product_price" value="<?php echo $row->product_price; ?>"/>
                            </div>
                            <div class="form-section-2">
								<label for="available_quantity" class="labels">Cantitate disponibilă (buc.):</label> </br>
                                <input class="fields" type="number" name="available_quantity"  value="<?php echo $row->available_quantity; ?>"/><br/>

                                </br>

                                <label for="product_img" class="labels">Încărcare imagine:</label> </br>
                                <input class="fields" type="text" name="product_img"  value="<?php echo $row->product_img; ?>"/><br/>
                                
                                </br>

                                <label class="labels">Categorie produs:</label> </br>
									<div>
										<?php
											$selectFromCategories = "SELECT category_name, category_id FROM categories GROUP BY category_name";
											$result = $conn->query($selectFromCategories);
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
                    
                                <?php
                                        }
                                    }
                            }?>
                            </div>
                    </div>  
                    </br>
                            <div class="buttons">
                                <input class="dark-button" type="submit" name="submit" value="Modifică produsul" /><br/>
                                <a class="links" href="../user/my_products.php">Produsele Mele</a>
                                <a class="links" href="../products_store/products_store.php">Înapoi la Magazin</a>
                                <a class="links" href="../user/welcome.php">Înapoi la Utilizator</a>
                            </div>
                </form>
            </div>     
        </div>
        <?php include_once("../shared_files/footer.php");?>
    </body>
</html>