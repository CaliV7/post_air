<?php
//lancement d'une session pour garder les infos de connexion 
session_start();

// connexion à la bdd pdo
require('connexion_bdd.php');

// verification que  mail et mdpasse de l'utilisateur sont en post 
if ((isset($_POST['email'])) && (isset($_POST['mdpasse']))) {
    $email = $_POST['email'];
    $password = $_POST['mdpasse'];

    // creation de la requete en pdo

    $stmt = $pdo->prepare("select * from users where email= ? ");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // verification que le mdpasse de la bdd correspond au mdp du post
    if ($user && password_verify($password, $user['mdpasse'])) {
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['id'] = $user['id'];
        echo "bonjour " . htmlentities($_SESSION['nom']) . " vous étes bien connecté";
        header('location:index.php');
    } else {
        echo 'email ou mot de passe incorrect';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST'AIR</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class='header'>
    <h1>POST'R le site contre l'ennui</h1>
    </header>

    <main class='main'>
        <div><h1>Connecte toi chez POST'R</h1>
        </div>
        <div class='main_page'>
            <img class="image_ognion" src="image/IMG_2768.jpeg" alt="">
        
        
            <div>
            <form class="form" method='post' action='login.php'>
                <input class='colonne_form' type='email' name='email' placeholder='Email' required>
                <input class='colonne_form' type='password' name='mdpasse' placeholder='Mot de passe' required>
                <button class='colonne_form' type='submit'>Connecte toi</button>
            </form>
            <a class='inscription' href="inscription.php">Pas encore de compte, tu peux t'inscrire ici </a>
            </div>
        </div>

    </main>

    <footer class='footer'>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>