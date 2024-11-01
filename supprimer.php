<?php
//lancement session
session_start();
//connexion a la bdd
include 'connexion_bdd.php';

// verif que le user est bien connecté par avec son id sinon renvoi àla page de connexion
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id'];
    //
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Supprimer les posts de l'utilisateur
    $stmt = $pdo->prepare("DELETE FROM posts WHERE user_id = ?");
    $stmt->execute([$id]);

    // Supprimer les likes de l'utilisateur a venir
    /*$stmt = $pdo->prepare("DELETE FROM likes WHERE user_id = ?");
    $stmt->execute([$id]);  */

    // Supprimer l'utilisateur
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt->execute([$id])) {
        // Détruire la session rediriger vers la page de connexion
        session_destroy();
        //renvoyer vers la page de connexion
        header("Location: login.php");
        exit;
    } else {
        echo "Erreur lors de la suppression de votre compte.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>POSTAIR</title>
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
        <H1>POSTAIR</H1>
        <H2>Supprimer votre compte</H2>
        <form method="post">
            <p> En cliquant sur le bouton, vous supprimerez votre comte</p>
            <button type='submit'>supprimer mon compte</button>

        </form>
    </main>
    <footer class='footer'>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>