<?php
//lancement d'une session pour garder les infos de connexion 
session_start();
if (isset($_SESSION['nom'])) {
    $nom = $_SESSION['nom'];
}


// connexion à la bdd en pdo
require('connexion_bdd.php');

// verification des données post et session a mettre dans la table post de la bdd
if ((isset($_SESSION['id'])) && (isset($_POST['titre'])) && (isset($_POST['contenu']))) {
    $user_id = $_SESSION['id'];

    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];


    //  preparation de la requete pour l'inscription des données dans la bdd
    $stmt = $pdo->prepare('insert into posts (user_id,titre,contenu) values (?,?,?)');
    //ajout des variables de valeurs dans la requete
    $stmt->execute([$user_id, $titre, $contenu]);

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
        <div class='titre_header'>
            <h1>POST'R</h1> <!--a remplacer par logo -->
        </div>
        <nav>
                <ul class='header_nav'>

                    <a href=''>Devinette</a>
                    <a href=''>charade</a>
                    <a href=''>blague</a>
                    <a href=''>blague pourrie</a>
                </ul>
            </nav>
        <div class='profil'>
            <a href="profil.php">Mon profil</a>
            <a href='logout.php'>Se déconnecter</a>
        </div>

    </header>
    <main>
        <div class='image'>
            <img src="image/IMG_2767.jpeg" alt="">
        </div>

        <div class='posts'>
            
            <div class='main_titre'>
            <h1>Bienvenue
                <?php if (isset($nom)) {
                    echo htmlentities($nom);
                }
                ?>
                chez POST'R</h1>
            </div>
            

                <?php
                require('posts.php');
                ?>
            
        </div>

    </main>

    <footer class='footer'>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>