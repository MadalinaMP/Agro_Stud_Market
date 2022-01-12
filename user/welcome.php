<?php
    session_start();

    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../error_messages/not_logged_in.php');
        exit;
    }
?>

<html>
    <head>
        <title><?php echo $_SESSION['name']." - Profil Agro Student Market"?></title>
        <link rel="stylesheet" href="welcome.css"/>
    </head>
    
    <body>
    <?php require_once ("../shared_files/header.php");?>

    <div class="center-form">
        <div class="form-section">
            <?php echo "<h1 class='titles'>Bine ai venit, ".$_SESSION['name']." !</h1>" ?>
            
            <button class="bright-button" onclick="window.location.href='../products_crud/create_product.php'">Încarcă un produs</button>
            </br>
            <button class="bright-button" onclick="window.location.href='my_products.php'">Produsele Mele</button>
            <button class="bright-button" onclick="window.location.href='../shopping_cart/cart.php'">Coșul Meu</button>
            </br>

            <a class="edit-links" href='edit_profile.php?user_id=<?php echo $_SESSION['id'] ?>'><button class="bright-button" onclick="window.location.href='edit_profile.php'">Modifică Datele Personale</button></a>
            <a class="edit-links" href='change_password.php?user_id=<?php echo $_SESSION['id'] ?>'><button class="bright-button" onclick="window.location.href='edit_profile.php'">Schimbă Parola</button></a>
            </br>
            
            </br>
            <div class="links">
                <a href="../products_store/products_store.php">Înapoi la Magazin</a></br>
                <a href="../products_store/products_store.php">Acasă</a>
            </div>
        </div>
    </div>

    <?php require_once("../shared_files/footer.php")?>
    </body>
</html>