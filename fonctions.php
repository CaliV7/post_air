<?php


// enregitre les posts dans la bdd
function publierPost($pdo){
    // verification des données post et session a mettre dans la table post de la bdd
    if ((isset($_SESSION['id'])) && (isset($_POST['titre'])) && (isset($_POST['contenu']))) {
        $user_id = $_SESSION['id'];

        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];


        //  preparation de la requete pour l'inscription des données dans la bdd
        $stmt = $pdo->prepare('insert into posts (user_id,titre,contenu) values (?,?,?)');
        //ajout des variables de valeurs dans la requete
        $stmt->execute([$user_id, $titre, $contenu]);
    }
}

