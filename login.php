<!DOCTYPE html>
<html>
    <head>
        <title>Connexion interface chercheur</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body id="login_ifrocean">
        <h1>Connexion interface chercheur</h1>
        <fieldset>
            <legend><h2>Accès chercheur</h2></legend>
            <form action="logged.php" method="post" id="align-form-login"> 
                <label for="pass">Mot de passe :</label>
                <input type="password" id="pass" name="pass"/>
                <div class="align-btn-droite">
                    <input type="submit" id="se_connecte"  class="bouton" name="se_connecte" value="Connexion"/>
                    <a href="index.php" class="bouton">Retour</a>
                </div>
            </form> 
        </fieldset>
    </body>       
</html>

        
        
     