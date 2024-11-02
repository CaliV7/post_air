<?php

require('connexion_bdd.php');

if (!isset($_SESSION['id'])) {
    header('location:login.php');
}

$user_id = $_SESSION['id'];
$stmt = $pdo->prepare("select * from posts where id= ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ((isset($_POST['nom']))  && (isset($_POST['age'])) && (isset($_POST['ville']))) {
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $ville = $_POST['ville'];
    $stmt = $pdo->prepare("UPDATE users SET nom=?,age=?,ville=? WHERE id=?");
    if ($stmt->execute([$nom, $age, $ville, $user_id])) {
        echo "les modifications ont bien été prises en compte";
    } else {
        echo "la modification a échoué";
    }
}
?>