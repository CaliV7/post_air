<?php

session_start();

$_SESSION = array();

unset($_SESSION);

session_destroy();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion de Post_air</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header class='header'>
        <div class='titre_header'>
    <!-- a remplacer par le logo -->
            <h1>POST'R le site contre l'ennui</h1>
        </div>

        <div class='header_lien'>
            <a href="login.php">Login</a>
            
        </div>

    </header>
    

    <main>
        <h1>Déconnexion de POST'R</h1>
        <div class='deconnexion'>
            <p>vous etes déconnecté, vous pouvez vous reconnecté</p>

            <a href='login.php' Login>Login</a>

        </div>

    </main>

    <footer class='footer'>

        <p>created by Abdelkrim 10/24</p>
    </footer>
</body>

</html>