<?php
//lancement d'une session pour garder les infos de connexion 
session_start();
if(isset($_SESSION['nom'])){
    $nom=$_SESSION['nom'];
}


// connexion à la bdd en pdo
require ('connexion_bdd.php');

// verification des données post et session a mettre dans la table post de la bdd
if((isset($_SESSION['id'])) && (isset($_POST['titre'])) && (isset($_POST['contenu']))){
    $user_id=$_SESSION['id'];

    $titre=$_POST['titre'];
    $contenu=$_POST['contenu'];  


//  preparation de la requete pour l'inscription des données dans la bdd
    $stmt=$pdo->prepare('insert into posts (user_id,titre,contenu) values (?,?,?)');
    //ajout des variables de valeurs dans la requete
    $stmt->execute([$user_id,$titre,$contenu]);

    echo 'Félicitation votre Post est maintenant publié';
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

    <h1>Bienvenue <?php echo htmlspecialchars($nom) ?> chez POST'AIR</h1>
        <form class='form' method='post' action='index.php'>
            <input type='text' name='titre' placeholder="entrer un titre" required>
            <textarea  name='contenu' placeholder="votre post" required></textarea>
            <button type='submit'>Poster</button>

        </form>

        <h2>POSTS</h2>
        
            
            <?php
            require ('posts.php');
            ?>

    </main>

    <footer class='footer'>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>