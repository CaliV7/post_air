<?php
session_start();




  

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST'AIR</title>
</head>

<body>
    <header>

        <nav>
            <ul>
                <a href='login.php' Login>Login</a>
                <a href='Index.php'>Post</a>
                <a href='Logout.php'>Déconnexion</a>
            </ul>

        </nav>
        <?php
        if ((isset($_SESSION['login'])) && (isset($_SESSION['password']))) {
            echo 'Bienvenue ' . $_SESSION['login'] . ' vous êtes connecté';
        } else {
            echo 'Connectez vous ';
        }
        ?>

    </header>
    <main>
        message a venir

    </main>

    <footer>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>