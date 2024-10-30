<?php
// connexion à la bdd avec mysqli
$conn=new mysqli('localhost', 'root', '', 'db_postair');
// fin de connexion bdd si erreur
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}
//verification que les données user sont bien en POST
if((isset($_POST['nom']))&&(isset($_POST['email']))&&(isset($_POST['age']))&&(isset($_POST['ville']))&&(isset($_POST['mdpasse']))){
    $nom=$_POST['nom'];
    $email=$_POST['email'];
    $age=$_POST['age'];
    $ville=$_POST['ville'];
    $mdpasse=$_POST['mdpasse'];

    //insertion des données user dans la bdd
    if($conn->query("insert into users (nom,email,age,ville,mdpasse) values ('$nom','$email','$age','$ville','$mdpasse')")){
    // message de reussite
    echo "Félicitation  $nom  vous étes maintenant inscris à POSTAIR";
}else{
    "Désolé l'inscription a echoué";
}
}
// fin de connexion à la bdd
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


    </header>
    <main>
        <h1>Bienvenue chez Post_air</h1><br>

        <p>remplissez les champs ci dessous pour creer votre compte et commencer à poster</p>

        <form method='post' action='inscription.php'>
            <input type='text' name='nom' placeholder='Votre nom' required>
            <input type='email' name='email' placeholder='votre email' required>
            <input type='int' name='age' placeholder="Votre age" required>
            <input type='text' name='ville' placeholder="Votre ville" required>
            <input type='password' name='mdpasse' placeholder="Votre mot de passe" required>
            <button type='submit'>Envoyer</button>
            
        </form>
    </main>

    <footer>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>