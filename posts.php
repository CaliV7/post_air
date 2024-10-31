<?php


// connexion à la bdd en pdo
require ('connexion_bdd.php');

   // joint les tables users et posts avec le id de users et le user_id de posts
   $stmt= $pdo->query("select * from posts left join users on posts.user_id=users.id ORDER BY date_post DESC LIMIT 5");
   // affiche les posts
   while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo "<div class='post'>";
    echo "<h3>". htmlentities($row['titre'])."</h3>" ;
    echo "post: ". htmlentities($row['contenu']);
    echo "posté par: " . htmlentities($row['nom']);
    echo "</div>";
   
   }



?>