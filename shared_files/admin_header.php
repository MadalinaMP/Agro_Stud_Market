<?php
echo "
    <div class=\"admin_header\">
        <div class=\"title\">
            <button class=\"back_button\" onclick=\"window.location.href='admin_welcome.php'\" title=\"Înapoi\"><</button>
            <h1> Agro Student Market ADMIN </h1>
        </div>

        <div class=\"tables\">
            <button class=\"table_buttons\" onclick=\"window.location.href='categories_table.php'\">categories</button>
            <button class=\"table_buttons\" onclick=\"window.location.href='orders_table.php'\">orders</button>
            <button class=\"table_buttons\" onclick=\"window.location.href='products_table.php'\">products</button>
            <button class=\"table_buttons\" onclick=\"window.location.href='users_table.php'\">users</button>
        </div>
    </div>
"
?>