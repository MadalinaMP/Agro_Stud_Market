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

	$user = new User();
	
	if (!empty($_GET["action"])) {
        switch ($_GET["action"]) {
            case "delete":
                $user-> deleteUser($_GET['user_id']);
                break;
        }
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Vizualizare Tabelă : users</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" href="../shared_files/item_tables.css"/>
	</head>
 	
	<body>
		<?php include_once("../shared_files/admin_header.php");?>

		<div class="gestionate">
			<h1>Înregistrările din tabela 'users'</h1>
			<?php
				if ($result = $admin_conn->query("SELECT * FROM users ORDER BY user_id")) { 
					if ($result->num_rows > 0) {
			?>
						<table>
							<tr>
								<th>user_id</th>
								<th>username</th>
								<th>email</th>
								<th>contact</th>
								<th>first_name</th>
								<th>last_name</th>
								<th>address</th>
								<th>Modifică</th>
								<th>Șterge</th>
							</tr>
					<?php
						while ($row = $result->fetch_object()) {
					?>
							<tr>
								<td><?php echo $row->user_id ?></td>
								<td><?php echo $row->username ?></td>
								<td><?php echo $row->email ?></td>
								<td><?php echo "+40 ".$row->contact ?></td>
								<td><?php echo $row->first_name?></td>
								<td><?php echo $row->last_name ?></td>
								<td><?php echo $row->address ?></td>
								<td><a href='user_update.php?user_id=<?php echo $row->user_id ?>'><img src="../icons/edit-icon-admin.png" alt="Modifică"/></a></td>
								<td><a href='users_table.php?action=delete&user_id=<?php echo $row->user_id ?>'><img src="../icons/icon-delete-admin.png" alt="Șterge"/></a></td>
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
			<a class="add_item" href="user_create.php">Adăugați un utilizator</a><br>
		</div>
		<?php include_once("../shared_files/log_out_icon.php");?>
 	</body>
</html>