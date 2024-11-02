<?php
session_start();
require('modifier.php');

require('supprimer.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Mon profil POST'R</title>
</head>

<body>
    <header class='header'>
        <div>
            <h1>POST'R le site contre l'ennui</h1>
        </div>
        <div class='header_lien'>
            <a href="index.php">Accueil</a>
            <a href='logout.php'>Se déconnecter</a>
        </div>
    </header>
    <main>
        <h1>Mon profil POST'R</h1>
        <div class='main_page'>
            <div>
                <H2>Modifier vos infos</H2>
                <form class='form' method='post'>
                    <input class="colonne_form" type='text' name='nom' value="<?= htmlentities($user['nom']) ?>" required>
                    <input class="colonne_form" type='int' name='age' value="<?= htmlentities($user['age']) ?>" required>
                    <input class="colonne_form" type='text' name='ville' value="<?= htmlentities($user['ville']) ?>" required>
                    <button class="colonne_form" type='submit'>Modifier</button>
                </form>
            </div>
            <div class='suprrimer_profil'>
                <H2>Supprimer votre compte</H2>
                <form method="post">
                    <p> En cliquant sur le bouton, vous supprimerez votre comte.</p><br>
                    <p>Attention cette action est irreversible.</p><br>
                    <button class="colonne_form" type='submit'>supprimer mon compte</button>

                </form>
            </div>
        </div>
        <h2>Modifier mes Posts</h2>
               
        <div class='posts'>
                <?php
                // connexion à la bdd en pdo
                require('connexion_bdd.php');

                // joint les tables users et posts avec le id de users et le user_id de posts
                $stmt = $pdo->query("select * from posts left join users on posts.user_id=users.id ORDER BY date_post DESC ");
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