<html>
    <head>
        <title> Parolă greșită </title>
        <link rel="stylesheet" href="errors.css"/>
    </head>

    <body>
        <?php include_once("../shared_files/header.php");?>

        <div class="center-form">
            <div class="form-section">
                <h2> Parola trebuie să fie între 5 și 20 caractere. </h2>
                </br>
                <button class="dark-button" onclick="history.go(-1);"> Ok </button>
            </div>
        </div>

        <?php include_once("../shared_files/footer.php")?>
    </body>
</html>