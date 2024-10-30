<?php

// connexion à la bdd avec mysqli
$conn=new mysqli('localhost', 'root', '', 'db_postair');
// fin de connexion bdd si erreur
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}
?>