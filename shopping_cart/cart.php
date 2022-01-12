<?php
    require_once "../connection/functions.php";
    session_start();

    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../error_messages/not_logged_in.php');
        exit;
    }

    $user_id=$_SESSION['id'];
    $shoppingCart = new ShoppingCart();

    if (!empty($_GET["action"])) {
        switch ($_GET["action"]) {
            case "add":
                if (! empty($_POST["quantity"])) {
                    $productResult = $shoppingCart->getProductByID($_GET["product_id"]);
                    
                    $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["product_id"], $user_id);
                }
                    if (!empty($cartResult)) {
                        $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"];
                        $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["cart_id"]);
                    } else {
                        $shoppingCart->addToCart($productResult[0]["product_id"], $_POST["quantity"], $user_id);
                    }
                break;
            case "remove":
                $shoppingCart->deleteCartItem($_GET["cart_id"]);
                break;
            case "empty":
                $shoppingCart->emptyCart($user_id);
                break;
        }
    }
?>
        <html>
        <head>
            <title>Coșul Meu</title>
            <link rel="stylesheet" href="cart.css"/>
        </head>
        <body>
            <?php include_once("../shared_files/header.php");?>

                <div class="label">
                    <h2>Cosul Meu</h2>
                    <a href="cart.php?action=empty"><img src="../icons/empty-cart.png" alt="empty-cart" class="empty" title="Golește Coșul" /></a>
                </div>
                
                <div class="display_my_products_section">
        <?php
            $cartItem = $shoppingCart->getUserIDCartItem($user_id);
            if (!empty($cartItem)) {
                $item_total = 0;
        ?>
                    <table>
                        <tbody>
                            <tr>
                                <th>Imagine</th>
                                <th>Denumire</th>
                                <th>Detalii Produs</th>
                                <th>Cantitate</th>
                                <th>Preț</th>
                                <th>Elimină</th>
                            </tr>
        <?php
            foreach ($cartItem as $item) {
        ?>
                            <tr>
                                <td><img src="<?php echo $item["product_img"]; ?>" width="64" height="100"></td>
                                <td><a href="../products_crud/read_product.php?product_id=<?php echo $item["product_id"];?>"><strong><?php echo $item["product_name"]; ?></strong></a></td>
                                <td><a href="../products_crud/read_product.php?product_id=<?php echo $item["product_id"];?>"><i>Vezi Detalii</i></a></td>
                                <td><?php echo "<strong>" . $item["quantity"] . "</strong> (buc.)"; ?></td>
                                <td><?php echo $item["product_price"]." <strong>RON</strong>"; ?></td>
                                <td>
                                    <a href="cart.php?action=remove&cart_id=<?php echo $item["cart_id"]; ?>">
                                        <img class="delete" src="../icons/icon-delete.png" alt="icon-delete" title="Elimină din coș" />
                                    </a>
                                </td>
                            </tr>
                
                <?php
                    $item_total += ($item["product_price"] * $item["quantity"]);
            }
        ?>
                            <tr>
                                <td class="total-row" colspan="6" align=left><strong>Total:</strong> <?php echo $item_total." <strong>RON</strong>"; ?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
        <?php
            } else {
                echo "Coșul este gol. Întoarce-te la Magazin pentru a adăuga produse noi.";
            }
        ?>
                </div>

                <div class="buttons">
                    <button class="dark-button" onclick="window.location.href='../orders/place_order.php'">Plasează Comanda</button><br>
                    <a class="links" href="../products_store/products_store.php">Înapoi la Magazin</a>
                    <a class="links" href="../user/welcome.php">Înapoi la Utilizator</a>
                </div>    

            <?php require_once("../shared_files/footer.php")?>
        </body>
    </html>