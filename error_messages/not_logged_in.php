<html>
    <head>
        <title> Restricționat. </title>
        <link rel="stylesheet" href="errors.css"/>
    </head>

    <body>
        <?php include_once("../shared_files/header.php");?>

        <div class="center-form">
            <div class="form-section">
                <h2> Acces restricționat. <br> Va trebui să te autentifici mai întâi. </h2>
                </br>
                <button class="dark-button" onclick="window.location.href='../log_in_page/log_in_page.php'"> Autentificare</button>
                <button class="bright-button" onclick="window.location.href='../register_page/register_page.php'"> Înregistrare</button>
            </div>
        </div>

        <?php include_once("../shared_files/footer.php")?>
    </body>
</html>