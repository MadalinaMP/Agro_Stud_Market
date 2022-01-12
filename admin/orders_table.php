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

	$order = new Order();
	
	if (!empty($_GET["action"])) {
        switch ($_GET["action"]) {
            case "delete":
                $order-> deleteOrder($_GET['order_id']);
                break;
        }
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
	<head>
		<title>Vizualizare Tabelă : orders</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" href="../shared_files/item_tables.css"/>
	</head>
 	
	<body>
		<?php include_once("../shared_files/admin_header.php");?>

		<div class="gestionate">
			<h1>Înregistrările din tabela 'orders'</h1>
			<?php
				if ($result = $admin_conn->query("SELECT * FROM orders ORDER BY order_id")) { 
					if ($result->num_rows > 0) {
			?>
						<table>
							<tr>
								<th>order_id</th>
								<th>first_name</th>
								<th>last_name</th>
								<th>email</th>
								<th>destination_address</th>
								<th>contact_client</th>
                                <th>order_status</th>
								<th>Modifică</th>
								<th>Șterge</th>
							</tr>
					<?php
						while ($row = $result->fetch_object()) {
					?>
							<tr>
								<td><?php echo $row->order_id ?></td>
								<td><?php echo $row->first_name ?></td>
								<td><?php echo $row->last_name ?></td>
                                <td><?php echo $row->email ?></td>
								<td><?php echo $row->destination_address ?></td>
								<td><?php echo $row->contact_client ?></td>
                                <td><?php echo $row->order_status ?></td>
								<td><a href='order_update.php?order_id=<?php echo $row->order_id ?>'><img src="../icons/edit-icon-admin.png" alt="Modifică"/></a></td>
								<td><a href='orders_table.php?action=delete&order_id=<?php echo $row->order_id ?>'><img src="../icons/icon-delete-admin.png" alt="Șterge"/></a></td>
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
			<a class="add_item" href="order_create.php">Adăugați o comandă</a><br>
		</div>
		<?php include_once("../shared_files/log_out_icon.php");?>
 	</body>
</html>