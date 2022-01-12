<?php
    include("../connection/connection.php");
    session_start();

    if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
        $id = $_GET['product_id'];
        if ($stmt = $conn->prepare("DELETE FROM products WHERE product_id= ? LIMIT 1")) {
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "</br>ERROR: Nu se poate șterge produsul!";
        }
        $conn->close();
    ?>

<html>
    <head>
        <title> Ștergere Confirmată </title>
        <link rel="stylesheet" href="delete_product.css"/>
    </head>
    <body>
        <?php include_once("../shared_files/header.php");?>

        <div class="center-form">
            <div class="form-section">
                <h2> Înregistrarea a fost ștearsă cu succes. </h2>
                </br>
                <button class="dark-button" onclick="window.location.href='../user/my_products.php'">Înapoi la Produsele Mele</button>
            </div>
        </div>

        <?php include_once("../shared_files/footer.php");?>
    </body>
</html>
    <?php
    }
?>