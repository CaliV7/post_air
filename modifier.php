<?php
session_start();
require('connexion_bdd.php');

if (!isset($_SESSION['id'])) {
    header('location:login.php');
}

$user_id = $_SESSION['id'];
$stmt = $pdo->prepare("select * from users where id= ?");
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
        <H2>Modifier vos infos</H2>
        <form class='form' method='post'>
            <input type='text' name='nom' value="<?=htmlentities($user['nom']) ?>" required>
            <input type='int' name='age' value="<?=htmlentities($user['age']) ?>"required>
            <input type='text' name='ville' value="<?=htmlentities($user['ville']) ?>" required>
            <button type='submit'>Modifier</button>

        </form>
    </main>
    <footer class='footer'>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>