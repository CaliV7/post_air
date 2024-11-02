<?php

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
        $_SESSION = array();
        unset($_SESSION);
        session_destroy();
        //renvoyer vers la page de connexion
        header("Location: login.php");
        exit;
    } else {
        echo "Erreur lors de la suppression de votre compte.";
    }
}
