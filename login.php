<?php
//lancement d'une session pour garder les infos de connexion 
session_start();

// connexion à la bdd mysqli
$conn=new mysqli('localhost','root','','db_postair');

// fin de la connexion si erreur
if($conn->connect_error){
    die("la connexion a echoué: " . $conn->connect_error);
}

// verification que  mail et mdpasse de l'utilisateur sont en post 
if((isset($_POST['email'])) && (isset($_POST['mdpasse']))){
    $email=$_POST['email'];
    $mdpasse=$_POST['mdpasse'];

    // importe toutes les donnees user par son email
    $result=$conn->query("select * from users where email='$email'");

    // verification que le mdpasse de la bdd correspond au mdp du post
    if($result->num_rows > 0){
        $user=$result->fetch_assoc();
        if($user['mdpasse'] === $mdpasse){
            $_SESSION['id']=$user['id'];
            echo 'connexion réussie';
        }else{
            echo 'email ou mot de passe incorrect.';
        }
    }else{
        echo 'Email ou mot de passe incorrect.';
    }

}

$conn->close();

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
                
                <a href='Index.php'>Post</a>
                <a href='Logout.php'>Déconnexion</a>
            </ul>

        </nav>

      

    </header>
    <main>
    <h1>Bienvenue chez Post_air</h1><br>

        <form method='post' action='login.php'>
            <input type='email' name='email' placeholder='Votre email' required>
            <input type='password' name='mdpasse' placeholder='votre mot de passe' required>
            <button type='submit'>Connectez vous</button>
            <a href="inscription.php">creez votre compte</a>
        </form>


    </main>

    <footer>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>