<?php session_start();
$_SESSION['logged'] = true;
?>

<html>
    <head>
        <title>Vous êtes connecté</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <META HTTP-EQUIV="Refresh" CONTENT="3; URL=index.php">
    </head>
    <body>
        <form action="chercheur" method="post"> 
            <div>
                "Vous êtes connecté !"
            </div>
        </form>    
    </body>       
</html>

