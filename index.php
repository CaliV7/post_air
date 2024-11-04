<?php
//lancement d'une session pour garder les infos de connexion 
session_start();
// connexion à la bdd en pdo
require('connexion_bdd.php');




if (isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}

// verification des données post et session a mettre dans la table post de la bdd
if ((isset($_SESSION['id'])) && (isset($_POST['titre'])) && (isset($_POST['contenu']))) {
    $user_id = $_SESSION['id'];
    $titre = trim($_POST['titre']);
    $contenu = trim($_POST['contenu']);

    if(strlen($titre) >200 || strlen($contenu)>500){
        echo "Le titre(max200) ou le contenu(max500) est trop long";
        exit();
    }
    //  preparation de la requete pour l'inscription des données dans la bdd
    $stmt = $pdo->prepare('insert into posts (user_id,titre,contenu) values (?,?,?)');
    //ajout des variables de valeurs dans la requete
    $stmt->execute([$user_id, $titre, $contenu]);

    /* a revoir pb l'affichage du msg qd on raffraichi la page si non redirigé
    echo 'Félicitation votre Post est maintenant publié';*/
    header('location:index.php');
    exit();
    }   

//recuperation des posts dans l'ordre de date decroissant
$post = $pdo->query("select * from posts join users on posts.user_id =users.id ORDER BY date_post DESC ");
$posts = $post->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST'AIR</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atma:wght@300;400;500;600;700&family=Londrina+Shadow&display=swap" rel="stylesheet"><!-- lien pour la police d'écriture qui s'appelle Atma -->
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
        <h1 class="bienvenue">Bienvenue
            <?php echo htmlentities($_SESSION['nom']); ?>
            sur POST'R</h1>

        <div class='main_page'>

            <div class='publi_contenu'>
                <form class='form' method='post'>
                    <label class="choose" for="titre">Choisissez un titre :</label>
                    <select class='colonne_form' name="titre">
                        <option value="Devinette">Devinette</option>
                        <option value="Charade">Charade</option>
                        <option value="Blague">Blague</option>
                        <option value="Blague pourrie">Blague pourrie</option>
                    </select>
                    <textarea class='form_contenu' name='contenu' placeholder="Votre post..." required></textarea>
                    <button class='bouton' type='submit'>Poster</button>
                </form>
            </div>
 
            <div class='posts'>
                <?php foreach ($posts as $post): ?>
                    <div class='post'>
                        <h3><strong><?php echo htmlentities($post['titre']); ?></strong></h3>
                        <br>
                        <p><?php echo htmlentities($post['contenu']); ?></p>
                        <br>
                        <p class="pubdate">Publié par <?php echo htmlentities($post['nom']); ?> </p><!-- J'aurai bien rajouté la date de publication-->

                    </div>
                    <?php endforeach; ?>
                </div>
           

    </main>

    <footer class='footer'>

        <p>Copyright Abdelkrim Octobre 2024</p>
    </footer>

</body>

</html>