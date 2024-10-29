<?php
//session
    session_start();
    

    if ((isset($_POST['login'])) && (isset($_POST['password'])) &&(isset($_POST['age']))){

    $_SESSION['login']=$_POST['login'];
    $_SESSION['password']=$_POST['password'];
    $_SESSIO['age']=$_POST['age'];

        //header('location:index.php');
        //exit();
}

// base de donnee
// Connexion à la base de données MySQL
$conn = new mysqli("localhost", "root", "", "db_postair");

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}


// enregistrement dans la base de donnée
if (isset($_POST['login']) &&(isset($_POST['password']))&&(isset($_POST['age']))) {
    
    $sql_insert = "INSERT INTO users (nom,password,age) VALUES ('{$_POST['login']}','{$_POST['password']}','{$_POST['age']}')";
    
    
    if ($conn->query($sql_insert) === TRUE) {
        echo "Nouvel enregistrement ajouté avec succès.";
    } else {
        echo "Erreur : " . $conn->error;
    }
    unset($_POST);
header('refresh:0');
}


// Fermeture de la connexion
$conn->close(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST'AIR</title>
</head>
<body>
    <header>

    <nav>
    <ul>
        <a href='login.php' Login>Login</a>
        <a href='Index.php'>Post</a>
        <a href='Logout.php'>Déconnexion</a>
    </ul>

    </nav>

    <?php
        if (isset($_SESSION['login'])){
            echo 'Bienvenue ' . $_SESSION['login'] . ' vous êtes connecté';
        } else {
            echo 'Connectez vous ';
        }
        ?>

    </header>
    <main>
    

    <form  method='post' target='_blank'>
    <input type='text' name='login' placeholder='Votre login' required>
    <input type='password' name='password' placeholder='votre mot de passe' required >
    <input type='int' name='age' placeholder="Votre age" required>
    <button type='submit'>Envoyer</button>  


    </form>

    </main>

    <footer >

<p>created by Abdelkrim 10/24</p>
</footer>

</body>
</html>