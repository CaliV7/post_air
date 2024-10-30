<?php


// connexion à la bdd mysqli
require ('connexion_bdd.php');

   // joint les tables users et posts avec le id de users et le user_id de posts
   $sql="select * from posts left join users on posts.user_id=users.id";
   $post=$conn->query($sql);
   while($row=$post->fetch_assoc()){
    echo "<div class='post'>";
    echo "<h3>". $row['titre']."</h3>" ;
    echo "post: ".$row['contenu'];
    echo "posté par: " .$row['nom'];
    echo "</div>";
   
   }


$conn->close();

?>