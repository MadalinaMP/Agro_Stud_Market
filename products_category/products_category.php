<?php
    require_once "../connection/functions.php";
    session_start();
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Agro Student Market - Magazin</title>
        <link rel="stylesheet" href="products_category.css" />
    </head>
    
    <body>
        <?php include_once("../shared_files/header.php");?>
        
        <?php
            $category_id = $_REQUEST["category_id"];
        ?>
        
        <div class="position_sections">
            <div class="categories_section">
                <h3> Categorii: </h3> </br>
                <?php
                    $category = new Category();
                    $query = "SELECT * FROM categories ORDER BY category_name";
                    $category_array = $category->getAllCategory($query);

                    if (!empty($category_array)) {
                        foreach ($category_array as $key => $value) {
                ?>
                            <button class="category_buttons" onclick="window.location.href=
                                '../products_category/products_category.php?category_id=<?php echo $category_array[$key]["category_id"]; ?>';">
                                <?php echo $category_array[$key]["category_name"]; ?>
                            </button>
                <?php
                        }
                    }
                ?>
            </div>
            
            <div class="display_products_section">
                <?php
                    $shoppingCart = new ShoppingCart();
                    $query = "SELECT * FROM products WHERE category_id = $category_id ORDER BY product_name";
                    $product_array = $shoppingCart->getAllProduct($query);
                    
                    if (!empty($product_array)) {
                        foreach ($product_array as $key => $value) {
                ?>
                
                            <div class="product">
                                <form method="post" action="../shopping_cart/cart.php?action=add&product_id=<?php echo $product_array[$key]["product_id"]; ?>">
                                    <div>
                                        <h3><a class="product_title" href='../products_crud/read_product.php?product_id=<?php echo $product_array[$key]["product_id"];?>'><?php echo $product_array[$key]["product_name"]; ?></a></h3>
                                    </div>
                                    
                                    <div>
                                    <a class="product_title" href='../products_crud/read_product.php?product_id=<?php echo $product_array[$key]["product_id"];?>'><img src="<?php echo $product_array[$key]["product_img"]; ?>" width="200" height="300"></a>
                                    </div>
                                    
                                    <div>
                                        <p>Pret: <?php echo $product_array[$key]["product_price"]; ?> RON
                                        <input type="hidden" name="quantity" value="1" size="2" /><br>
                                        <a href="../products_crud/read_product.php?product_id=<?php echo $product_array[$key]["product_id"];?>">Vezi detalii</a>
                                    </div>
                                    
                                    <div>
                                        <input class="add_to_cart_botton" type="submit" value="Adaugă în cos"/>
                                    </div>
                                </form>
                            </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>

        <?php include_once("../shared_files/footer.php");?>
</body>
</html>