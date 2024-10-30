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
<header>

<nav>
<ul>
    
    <a href='Index.php'>Post</a>
    <a href='Logout.php'>Déconnexion</a>
</ul>

</nav>

</header>
<main>
vous etes déconnecté, vous pouvez vous reconnecté <a href='login.php' Login>Login</a>

</main>

<footer >

<p>created by Abdelkrim 10/24</p>
</footer>
</body>
</html>