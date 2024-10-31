<?php
require('connexion_bdd.php');

//verification que les données user sont bien en POST
if((isset($_POST['nom']))&&(isset($_POST['email']))&&(isset($_POST['age']))&&(isset($_POST['ville']))&&(isset($_POST['mdpasse']))){
    $nom= $_POST['nom'];
    $email=$_POST['email'];
    $age=$_POST['age'];
    $ville=$_POST['ville'];
    $password=$_POST['mdpasse'];
    

    // controle que l'email n'est pas deja existant sinon msg d'erreur
    $stmt= $pdo->prepare('select * from users where email=?');
    $stmt->execute([$email]);

        if($stmt->rowCount() > 0 ){
            echo 'Cet Email est déja inscrit';
        }else{
        //cryptage du mot de passe 
         $hashedPassword= password_hash($password,PASSWORD_DEFAULT);
          //preparation de la requete sans les valeurs
         $stmt=$pdo->prepare("insert into users (nom,email,age,ville,mdpasse) values (?,?,?,?,?)");
            // ajout des variables de valeurs
        $stmt->execute([$nom,$email,$age,$ville,$hashedPassword]);
            // message de reussite
         echo "Félicitation ". htmlentities($nom) ." vous étes maintenant inscris à POSTAIR. Connectez vous pour consulter et envoyer des posts";
         header('location:login.php');
        } 
    }else{
        echo 'Merci de remplir tous les champs';
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

        <nav>
            <ul>
                <a href='login.php' Login>Login</a>
                <a href='Index.php'>Post</a>
                <a href='Logout.php'>Déconnexion</a>
            </ul>

        </nav>


    </header>
    <main>
        <h1>Bienvenue chez POST'AIR</h1><br>

        <p>remplissez les champs ci dessous pour creer votre compte et commencer à poster</p>

        <form class='form' method='post' >
            <input type='text' name='nom' placeholder='Votre nom' required>
            <input type='email' name='email' placeholder='votre email' required>
            <input type='int' name='age' placeholder="Votre age" required>
            <input type='text' name='ville' placeholder="Votre ville" required>
            <input type='password' name='mdpasse' placeholder="Votre mot de passe" required>
            <button type='submit'>Envoyer</button>
            
        </form>
    </main>

    <footer class='footer'>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>