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

    if(isset($_POST['submit']))
	{		
		$category_name=htmlentities($_POST['category_name'], ENT_QUOTES);

		$sql = "INSERT INTO categories(category_name) VALUES (?)";
		if($stmt = $admin_conn -> prepare($sql))
		{
			$stmt->bind_param("s", $category_name);
			$stmt->execute();
			$stmt->close();
			header('location: categories_table.php');
		} else {
			echo "</br>ERROR: Nu se poate executa insert!";
		}
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html>
		<head>
			<title>Încarcă o categorie - Admin</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<link rel="stylesheet" href="../shared_files/update_create_item.css"/>
		</head>

		<body>
			<?php include_once("../shared_files/admin_header.php");?>
			
			<div class="center-form">
				<h1 class="titles">Încarcă o categorie:</h1> </br>
					<form action="" method="post">
						<label for="category_name" class="labels">Denumire categorie:</label> </br>
						<input class="fields" type="text" name="category_name" placeholder="Introduceți denumirea categoriei" required/> </br>
                        
                        </br>
                                
					    <input class="submit_button" type="submit" name="submit" value="Adaugă Categorie"/>
					</form>
					<?php $admin_conn->close(); ?>
					</br>
                    <a href="categories_table.php">Înapoi la tabela 'categories'</a>
			</div>
			<?php include_once("../shared_files/log_out_icon.php");?>
		</body>
	</html>