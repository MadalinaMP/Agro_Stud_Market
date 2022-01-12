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
    $category_id=$_GET['category_id'];

    if(isset($_POST['submit']))
	{
		$category_name=htmlentities($_POST['category_name'], ENT_QUOTES);
		
        $sql = "UPDATE categories SET category_name=? WHERE category_id='".$category_id."'";    
        if ($stmt = $admin_conn->prepare($sql))
        {
            $stmt->bind_param("s", $category_name);
            $stmt->execute();
            $stmt->close();
            header('location: categories_table.php');
        } else {
            echo "ERROR: Nu se poate executa update.";
        }
    }
?>

<html>
    <head>
        <title>Editează Categoria - Admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="../shared_files/update_create_item.css"/>
    </head>
    
    <body>
        <?php include_once("../shared_files/admin_header.php");?>
        
        <div class="center-form">
			<h1 class="titles">Editează Categoria</h1> </br>
                
            <form action="" method="post">
                <?php
                    if ($_GET['category_id'] != '') {
                ?>
                        <?php
                            if ($result = $admin_conn->query("SELECT * FROM categories where category_id='".$_GET['category_id']."'")) {
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_object();
                        ?>
                                           
                        <label for="category_name" class="labels">Denumire categorie:</label> </br>
                        <input class="fields" type="text" name="category_name" value="<?php echo $row->category_name; ?>" required/><br/>
                                          
                        <?php
                                    }
                                }
                            }
                        ?>  
                    </br>
                        <input class="submit_button" type="submit" name="submit" value="Modifică categoria" />
            </form>
            <a href="categories_table.php">Înapoi la tabela 'categories'</a>
        </div>
        <?php include_once("../shared_files/log_out_icon.php");?>
    </body>
</html>