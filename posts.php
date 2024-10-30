<?php


// connexion à la bdd en pdo
require ('connexion_bdd.php');

   // joint les tables users et posts avec le id de users et le user_id de posts
   $stmt= $pdo->query("select * from posts left join users on posts.user_id=users.id");
   // affiche les posts
   while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo "<div class='post'>";
    echo "<h3>". $row['titre']."</h3>" ;
    echo "post: ".$row['contenu'];
    echo "posté par: " .$row['nom'];
    echo "</div>";
   
   }



?>