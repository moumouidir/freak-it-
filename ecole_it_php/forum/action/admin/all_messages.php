<?php

require('../connection_BDO.php');
require('../users/security_login.php');
require('bar_nav_forum.php');




$req =$bdd->prepare('SELECT * FROM messages');
$req->execute();
$data =$req->fetchAll();


echo "<link rel=' stylesheet' href='../../assets/style_Allcategory.css'>";


echo "<form       method='POST'>
        <table class ='tab'>
        <tr>
         <th>N° Messages</th>
         <th>PSEUDO_USER</th>
         <th>ID_TOPIC</th>
         <th>CONTENU</th>
         </tr>";

    
foreach ($data as $row){
        $id_data = $row["ID_M"];
        echo "<tr>
         <td>" . $row["ID_M"] . "</td>
         <td>" . $row["PSEUDO_USER"] . "</td>
         <td>" . $row["ID_TOPIC"] . "</td>
         <td>". $row["CONTENU"] . "</td>
        <td><input type='checkbox' value=" . $id_data . " name='id_data[]'></td>
         </tr>";
}
echo "</table>";
echo "<input type='submit' id='btn_del' value='Supprimer' name='delete' formaction ='delete_messages.php'>";

echo "</form>";    

