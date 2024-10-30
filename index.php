<?php
//lancement d'une session pour garder les infos de connexion 
session_start();

// connexion à la bdd mysqli
$conn=new mysqli('localhost','root','','db_postair');

// fin de la connexion si erreur
if($conn->connect_error){
    die("la connexion a echoué: ". $conn->connect_error);
}

// recuperation des données a mettre dans la table post de la bdd
if((isset($_SESSION['user_id'])) && (isset($_POST['titre'])) && (isset($_POST['contenu']))){
    $user_id=$_SESSION['user_id'];
    $titre=$_POST['titre'];
    $contenu=$_POST['contenu'];
    

// inscription des données dans la tables posts de la bdd
    if($conn->query("insert into posts(user_id,titre,contenu) values('$user_id','$titre','$contenu')")){
    echo 'Félicitation votre Post est maintenant publié';
}else{
    echo 'Désolé,votre Post ne peut pas etre publié';
}
}

//fin de connexion a la bdd
$conn->close();
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
    <header>

        <nav>
            <ul>
                
                <a href='Index.php'>Post</a>
                <a href='Logout.php'>Déconnexion</a>
            </ul>

        </nav>
        
        
    </header>
    <main>
        <form method='post' action='index.php'>
            <input type='text' name='titre' placeholder="entrer un titre" required>
            <textarea  name='contenu' placeholder="votre post" required></textarea>
            <button type='submit'>Poster</button>

        </form>

        <h2>POSTS</h2>
        
            
            

    </main>

    <footer>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>