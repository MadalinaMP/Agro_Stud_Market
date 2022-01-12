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

	$category = new Category();
	
	if (!empty($_GET["action"])) {
        switch ($_GET["action"]) {
            case "delete":
                $category-> deleteCategory($_GET['category_id']);
                break;
        }
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
	<head>
		<title>Vizualizare Tabelă : categories</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" href="../shared_files/item_tables.css"/>
	</head>
 	
	<body>
		<?php include_once("../shared_files/admin_header.php");?>

		<div class="gestionate">
			<h1>Inregistrările din tabela 'categories'</h1>
			<?php
				if ($result = $admin_conn->query("SELECT * FROM categories ORDER BY category_id")) { 
					if ($result->num_rows > 0) {
			?>
						<table>
							<tr>
								<th>category_id</th>
								<th>category_name</th>
								<th>Modifică</th>
								<th>Șterge</th>
							</tr>
					<?php
						while ($row = $result->fetch_object()) {
					?>
							<tr>
								<td><?php echo $row->category_id ?></td>
								<td><?php echo $row->category_name ?></td>
								<td><a href='category_update.php?category_id=<?php echo $row->category_id ?>'><img src="../icons/edit-icon-admin.png" alt="Modifică"/></a></td>
								<td><a href='categories_table.php?action=delete&category_id=<?php echo $row->category_id ?>'><img src="../icons/icon-delete-admin.png" alt="Șterge"/></a></td>
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
			<a class="add_item" href="category_create.php">Adăugați o categorie</a><br>
		</div>

		<?php include_once("../shared_files/log_out_icon.php");?>
 	</body>
</html>