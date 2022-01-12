<?php
    if (!isset($_SESSION['loggedin'])) {
        $logged = "Utilizator";
    } else {
        $logged = $_SESSION['name'];
    } 

echo "
    <div class=\"header\">
        <div class=\"home-section\">
            <button class=\"back-button\" onclick=\"history.go(-1);\" title=\"Înapoi\"> < </button>
            <img class=\"logo\" src=\"../icons/logo.png\" />
        </div>
        <div class=\"buttons-section\">
            <a href=\"../products_store/products_store.php\"><input class=\"header-buttons\" type=\"button\" value=\"Magazin\"/></a>
            <a href=\"../log_in_page/log_in_page.php\"><input class=\"header-buttons\" type=\"button\" value=\"Autentificare\"></a>
            <a href=\"../register_page/register_page.php\"><input class=\"header-buttons\" type=\"button\" value=\"Înregistrare\"/></a>
            <a href=\"../about/about.pdf\" target=\"_blank\"><input class=\"header-buttons\" type=\"button\" value=\"Detalii\"/></a>
            <a href=\"../shopping_cart/cart.php\"><input class=\"header-buttons\" type=\"button\" value=\"Coș\"/></a>
            <a href=\"../user/welcome.php\"><input class=\"header-buttons\" type=\"button\" value=". $logged ." </a>
            <a href=\"../log_out/log_out.php\"><input class=\"header-buttons\" type=\"button\" value=\"Deconectare\"></a>
        </div>
    </div>
"
?>