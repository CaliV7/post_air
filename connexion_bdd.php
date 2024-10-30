<?php

// connexion à la bdd avec pdo
$dsn = "mysql:host=localhost;dbname=db_postair;charset=utf8mb4";
$username= 'root';
$password= '';
$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    //recuperation des erreurs dans tableau associatif
    ];
    try {
        $pdo = new PDO($dsn,$username,$password,$options);
    }   catch (Exception $e) {
        error_log($e->getMessage());
        die("une erreur s'est produite");
    }
    
?>