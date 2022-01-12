<?php
    require_once "../connection/functions.php";
?>

<?php
    session_start();

    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../error_messages/not_logged_in.php');
        exit;
    }
    
    $user_id=$_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produsele Mele</title>
    <link rel="stylesheet" href="my_products.css"/>
</head>
    <body>
        <?php require_once ("../shared_files/header.php");?>
        <div class="label">
            <h2>Produsele Mele:</h2>
            <a href="../products_crud/create_product.php"><img src="../icons/add-product.png" class="add" title="Adauga Produs" /></a>
        </div>
        <div class="display_my_products_section">
                    <?php
                        $shoppingCart = new ShoppingCart();
                        $query = "SELECT * FROM products WHERE user_id=$user_id ORDER BY product_name";
                        $product_array = $shoppingCart->getAllProduct($query);
                        
                        if (!empty($product_array)) {
                            foreach ($product_array as $key => $value) {
                    ?>
                                <div class="my_product">
                                    <form method="post" action="../shopping_cart/cart.php?action=add&product_id=<?php echo $product_array[$key]["product_id"]; ?>">
                                        <div>
                                            <img class="list_item" src="../icons/list-item.png" />
                                            <img src="<?php echo $product_array[$key]["product_img"]; ?>" width="200" height="300">
                                        </div>
                                        
                                        <div>
                                            <h3><a href="../products_crud/read_product.php?product_id=<?php echo $product_array[$key]["product_id"];?>"><?php echo $product_array[$key]["product_name"]; ?></a></h3>
                                            <a href="../products_crud/update_product.php?product_id=<?php echo $product_array[$key]["product_id"];?>"><img class="action_icon" src="../icons/edit-icon.png" alt="Modifică"/></a>
                                            <a href="../products_crud/delete_product.php?product_id=<?php echo $product_array[$key]["product_id"];?>"><img class="action_icon" src="../icons/icon-delete.png" alt="Șterge"/></a>
                                        </div>
                                    </form>
                                </div>
                    <?php
                            }
                        } else {
                            echo "Nu ai încărcat încă produse. Apasă pe + pentru a încărca produse noi.";
                        }
                    ?>
                </div>  
            </div>
        
        <?php require_once("../shared_files/footer.php")?>
    </body>
</html>