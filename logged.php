<?php
session_start();
$_SESSION['logged'] = true;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Connexion réussie</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <meta http-equiv="Refresh" content="3; url=tablechercheur.php">
    </head>
    <body id="logged_ifrocean">
        <div class="valide_content">
            <h1>Connexion réussie !</h1>
            <p>Si vous n'êtes pas redirigé dans quelques secondes, cliquez sur ce <a href="tablechercheur.php">lien</a>.</p>
        </div>  
    </body>       
</html>

