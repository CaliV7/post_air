<?php
session_start();

require('connexion_bdd.php');

if (isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit;
}

// recuperer les infos users
$user_id = $_SESSION['id'];
$stmt = $pdo->prepare("SELECT * FROM users where id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($user) {
    $nom = $user['nom'] ?? '';
    $age = $user['age'] ?? '';
    $ville = $user['ville'] ?? '';
} else {
    $nom = $age = $ville = '';
}

// recuperer les posts users
$posts = $pdo->prepare("SELECT * FROM posts where user_id=?");
$posts->execute([$user_id]);
$user_posts = $posts->fetchAll(PDO::FETCH_ASSOC);

//modifier le profil user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modif_profil'])) {
    $nom = htmlentities(trim($_POST['nom']));
    $age = htmlentities(trim($_POST['age']));
    $ville = htmlentities(trim($_POST['ville']));
    $stmt = $pdo->prepare("UPDATE users SET nom=?,age=?,ville=? WHERE id=? ");
    $stmt->execute([$nom, $age, $ville, $user_id]);

    $_SESSION['nom'] = $nom;
    header('location:profil.php');
    exit();
}

//suppression du compte et des posts associés
if (isset($_POST['suppr_profil'])) {

    //suppression des posts
    $stmt = $pdo->prepare("DELETE FROM posts WHERE user_id=? ");
    $stmt->execute([$user_id]);

    // suppression du compte
    $stmt = $pdo->prepare("DELETE FROM users WHERE id=? ");
    $stmt->execute([$user_id]);

    // fin de session et redirection sur login
    session_unset();
    session_destroy();
    header('location:login.php');
    exit();
}

// recuperer les posts users
$posts = $pdo->prepare("SELECT * FROM posts where user_id=? ORDER BY date_post DESC");
$posts->execute([$user_id]);
$user_posts = $posts->fetchAll(PDO::FETCH_ASSOC);

//modifier les posts
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modif_post'])) {
    $post_id = $_POST['post_id'];
    $titre = htmlentities(trim($_POST['titre']));
    $contenu = htmlentities(trim($_POST['contenu']));
    
    $stmt = $pdo->prepare("UPDATE posts SET titre=?,contenu=? WHERE id=?");
    $stmt->execute(["$titre", "$contenu", "$post_id"]);
    header('location:profil.php');
    exit();
}
//supprimer post
if (isset($_POST['suppr_post'])) {
    $post_id = $_POST['post_id'];
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id=?");
    $stmt->execute([$post_id]);
    header('location:profil.php');
    exit();
}
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
                    <input class="colonne_form" type='text' name='nom' value="<?php echo htmlentities(trim($nom)); ?>" required>
                    <input class="colonne_form" type='number' name='age' value="<?php echo htmlentities(trim($age)); ?>" required>
                    <input class="colonne_form" type='text' name='ville' value="<?php echo htmlentities(trim($ville)); ?>" required>
                    <button class="colonne_form" type='submit' name="modif_profil">Modifier</button>
                </form>
            </div>
            <div class='suprrimer_profil'>
                <H2>Supprimer votre compte</H2>
                <form method="post">
                    <p> En cliquant sur le bouton, vous supprimerez votre comte.</p><br>
                    <p>Attention cette action est irreversible.</p><br>
                    <button class="colonne_form" type='submit' name='suppr_profil'>supprimer mon compte</button>

                </form>
            </div>
        </div>

        <h2>Modifier mes Posts</h2>
        <div class=''>
            <?php if (!empty($user_posts)) { ?>
                <div class='posts_profil'>
                    <?php foreach ($user_posts as $post): ?>

                        <form class='post_profil' method='post'>

                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>"> <!-- Ajout d'un champ caché pour l'ID du post -->
                            <input class="colonne_form" type='text' name='titre' value="<?php echo htmlentities($post['titre']); ?>" required>
                            <br><br>
                            <textarea class="form_contenu_profil" name='contenu' required>"<?php echo htmlentities(trim($post['contenu'])); ?>" </textarea>
                            <button class='colonne_form' type='submit' name='modif_post'>Modifier</button>
                            <button class='colonne_form' type='submit' name='suppr_post'>Supprimer</button>


                        </form>

                <?php endforeach;
                } else {
                    echo "aucun posts à modifier";
                }
                ?>

                </div>
        </div>
    </main>
    <footer class='footer'>

        <p>created by Abdelkrim 10/24</p>
    </footer>
</body>

</html>