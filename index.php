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

    /* a revoir pb l'affichage du msg qd on raffraichi la page si non redirigé
    echo 'Félicitation votre Post est maintenant publié';*/
    header('location:index.php');
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
    <!-- a remplacer par le logo -->
            <h1>POST'R le site contre l'ennui</h1>
        </div>

        <div class='header_lien'>
            <a href="profil.php">Mon profil</a>
            <a href='logout.php'>Se déconnecter</a>
        </div>

    </header>
    <main>
        <h1>Bienvenue
            <?php if (isset($nom)) {
                echo htmlentities($nom);
            }
            ?>
            chez POST'R</h1>

        <div class='main_page'>
            <div>
                <img class='image_brebis' src="image/IMG_2767.jpeg" alt="">
            </div>

           
            <div>
        <form class='form' method='post'>
            <label  for="titre">Choisissez un titre :</label>
            <select class='colonne_form' name="titre">
                <option value="Devinette">Devinette</option>
                <option value="Charade">Charade</option>
                <option value="Blague">Blague</option>
                <option value="Blague pourrie">Blague pourrie</option>
            </select>
            <textarea name='contenu' placeholder="votre post" required></textarea>
            <button class='colonne_form' class='bouton' type='submit'>Poster</button>
        </form>
        </div>

        </div>   
       
        <div class='posts'>
                <?php
                // connexion à la bdd en pdo
                require('connexion_bdd.php');

                // joint les tables users et posts avec le id de users et le user_id de posts
                $stmt = $pdo->query("select * from posts left join users on posts.user_id=users.id ORDER BY date_post DESC");
                // affiche les posts
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='post'>";
                    echo "<h3>" . htmlentities($row['titre']) . "</h3>" . "<br>";
                    echo  htmlentities($row['contenu']) . "<br>" . "<br>";
                    echo "Posté par: " . htmlentities($row['nom']);
                    echo "</div>";
                    
                }
                ?>
            </div>

    </main>

    <footer class='footer'>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>