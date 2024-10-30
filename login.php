<?php
//lancement d'une session pour garder les infos de connexion 
session_start();

// connexion à la bdd pdo
require ('connexion_bdd.php');

// verification que  mail et mdpasse de l'utilisateur sont en post 
if((isset($_POST['email'])) && (isset($_POST['mdpasse']))){
    $email=$_POST['email'];
    $password=$_POST['mdpasse'];

    // creation de la requete en pdo
    
    $stmt=$pdo->prepare("select * from users where email= ? ");
    $stmt->execute([$email]);
    $user=$stmt->fetch(PDO::FETCH_ASSOC);

    // verification que le mdpasse de la bdd correspond au mdp du post
    if($user && password_verify ($password,$user['mdpasse'])){
        $_SESSION['nom']=$user['nom'];
        $_SESSION['id']=$user['id'];
        echo "bonjour " . htmlspecialchars($_SESSION['nom']). " vous étes bien connecté";
        header('location:index.php');
    }else{
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

        <nav>
            <ul>
                <a href='Login.php'>Login</a>
                <a href='Index.php'>Post</a>
                <a href='Logout.php'>Déconnexion</a>
            </ul>

        </nav>

      

    </header>
    <main>
    <h1>Bienvenue chez POST'AIR</h1><br>

        <form class="form" method='post' action='login.php' >
            <input type='email' name='email' placeholder='Votre email' required>
            <input type='password' name='mdpasse' placeholder='votre mot de passe' required>
            <button type='submit'>Connectez vous</button>
            <a href="inscription.php">creez votre compte</a>
        </form>


    </main>

    <footer class='footer'>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>