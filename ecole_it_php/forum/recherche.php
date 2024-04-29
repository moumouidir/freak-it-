<?php
require("action/connection_BDO.php");

require("includes/bar_nav_forum.php");
echo "<link rel='stylesheet' href='assets/style_recherche.css'>";
   
   if(isset($_GET['search']) && !empty($_GET['search'])) {
    $word_search=htmlspecialchars($_GET['search']);
    $req_recherche=$bdd->prepare("SELECT * FROM sujets
    INNER JOIN messages ON sujets.ID_TOPIC = messages.ID_TOPIC
    WHERE TITLE LIKE '%$word_search%' OR CONTENU LIKE '%$word_search%' ");
    $req_recherche->execute();
    $result_search=$req_recherche->fetchAll(PDO::FETCH_ASSOC);
   
    if (empty($result_search)) {
           echo"<h2>Résultats de la recherche pour : $word_search</h2> ";
            
           echo "il ya pas de result pour votre recherche" ;
          
        }else {
            echo"<h2>Résultats de la recherche pour : $word_search</h2> ";

            echo "<table class=tab>";
        echo "<tr><th>Titre</th><th>Contenu</th></tr>";
        foreach ($result_search as $resultat) {
            echo "<tr><td>" . $resultat['TITLE'] . "</td><td>" . $resultat['CONTENU'] . "</td></tr>";
        }
        echo "</table>";

        }



    
    }else{
        echo  " le champs  de recherche est vide ";

   
    }
    




?>

