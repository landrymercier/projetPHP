<?php session_start();
$_SESSION['logged'] = true;
?>

<html>
    <head>
        <title>Connexion réussie</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <meta http-equiv="Refresh" content="3; url=index.php">
    </head>
    <body id="logged_ifrocean">
        <form action="chercheur" method="post"> 
            <div class="valide_content">
                <h1>Connexion réussie !</h1>
                <p>Si vous n'êtes pas redirigé dans quelques secondes, cliquez sur ce <a href="index.php">lien</a>.</p>
            </div>
        </form>    
    </body>       
</html>

