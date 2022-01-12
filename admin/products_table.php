<?php
	include("admin_connection.php");
	include("admin_functions.php");
    $error = "";

    session_start();

    if (!isset($_SESSION['admin_loggedin'])) {
        header('Location: restricted.php');
        exit;
    }

    $admin_id=$_SESSION['adminid'];

	$product = new Product();

	if (!empty($_GET["action"])) {
        switch ($_GET["action"]) {
            case "delete":
                $product-> deleteProduct($_GET['product_id']);
                break;
        }
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
	<head>
		<title>Vizualizare Tabelă : products</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" href="../shared_files/item_tables.css"/>
 	</head>
 	
	<body>
		<?php include_once("../shared_files/admin_header.php");?>

		<div class="gestionate">
			<h1>Înregistrările din tabela 'products'</h1>
			<?php
				if ($result = $admin_conn->query("SELECT * FROM products ORDER BY product_id")) { 
					if ($result->num_rows > 0) {
			?>
						<table>
							<tr>
								<th>product_id</th>
								<th>user_id</th>
								<th>product_name</th>
								<th>product_detail</th>
								<th>product_price</th>
								<th>available_quantity</th>
								<th>category_id</th>
								<th>product_img</th>
								<th>Modifică</th>
								<th>Șterge</th>
							</tr>
					<?php
						while ($row = $result->fetch_object()) {
					?>
							<tr>
								<td><?php echo $row->product_id ?></td>
								<td><?php echo $row->user_id ?></td>
								<td><?php echo $row->product_name ?></td>
								<td><?php echo $row->product_detail ?></td>
								<td><?php echo $row->product_price ?></td>
								<td><?php echo $row->available_quantity ?></td>
								<td><?php echo $row->category_id ?></td>
								<td><?php echo $row->product_img ?></td>
								<td><a href='product_update.php?product_id=<?php echo $row->product_id ?>'><img src="../icons/edit-icon-admin.png" alt="Modifică"/></a></td>
								<td><a href='products_table.php?action=delete&product_id=<?php echo $row->product_id ?>'><img src="../icons/icon-delete-admin.png" alt="Șterge"/></a></td>
							</tr>
					<?php		
						}
					?>
						</table>
					<?php	
					} else {
						echo "</br>Momentan nu există înregistrări în tabelă.";
					}
				} else {
					echo "Error: " . $admin_conn->error();
				}
				$admin_conn->close();
					?>
				<a class="add_item" href="product_create.php">Adăugați un produs</a><br>
		</div>
		<?php include_once("../shared_files/log_out_icon.php");?>
 	</body>
</html>