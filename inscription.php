<?php
require('connexion_bdd.php');

//verification que les données user sont bien en POST
if ((isset($_POST['nom'])) && (isset($_POST['email'])) && (isset($_POST['age'])) && (isset($_POST['ville'])) && (isset($_POST['mdpasse']))) {
    $nom = htmlentities(trim($_POST['nom']));
    $email = filter_var(trim($_POST['email']));
    $age = filter_var(trim($_POST['age']));
    $ville = htmlentities(trim($_POST['ville']));
    $password = $_POST['mdpasse'];

    if($age===false||$age<1||$age>120){
        echo "Age invalide";
        exit();
    }


    // controle que l'email n'est pas deja existant sinon msg d'erreur
    $stmt = $pdo->prepare('select * from users where email=?');
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo 'Cet Email est déja inscrit';
    } else {
        //cryptage du mot de passe 
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        //preparation de la requete sans les valeurs
        $stmt = $pdo->prepare("insert into users (nom,email,age,ville,mdpasse) values (?,?,?,?,?)");
        // ajout des variables de valeurs
        $stmt->execute([$nom, $email, $age, $ville, $hashedPassword]);
        // message de reussite
        echo "Félicitation " . htmlentities($nom) . " vous étes maintenant inscris à POSTAIR. Connectez vous pour consulter et envoyer des posts";
        header('location:login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Postr'R</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class='header'>
        <h1>POST'R le site contre l'ennui</h1>

        <div class='header_lien'>
            <a href="login.php">Login</a>
        </div>
    </header>

    <main class='main'>
        <h1>Inscrit toi chez POST'R</h1>
        <div class='main_page'>
            <img class='image_brebis' src="image/IMG_2767.jpeg" alt="">
           
            <div class='form_inscription'>

                <p>remplissez les champs ci dessous pour creer votre compte et commencer à poster</p>

                <form class='form' method='post'>
                    <input class='colonne_form' type='text' name='nom' placeholder='Votre nom' required>
                    <input class='colonne_form' type='email' name='email' placeholder='votre email' required>
                    <input class='colonne_form' type='int' name='age' placeholder="Votre age" required>
                    <input class='colonne_form' type='text' name='ville' placeholder="Votre ville" required>
                    <input class='colonne_form' type='password' name='mdpasse' placeholder="Votre mot de passe" required>
                    <button class='colonne_form' type='submit'>Envoyer</button>

                </form>

            </div>
        </div>
    </main>

    <footer class='footer'>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>