<?php

require('../connection_BDO.php');
require('../users/security_login.php');
require('bar_nav_forum.php');




$req_all_topic =$bdd->prepare('SELECT * FROM sujets');
$req_all_topic->execute();
$data =$req_all_topic->fetchAll();


echo "<link rel=' stylesheet' href='../../assets/style_Allcategory.css'>";


echo "<form       method='POST'>
        <table class ='tab'>
        <tr>
         <th>ID_USER</th>
         <th>PSEUDO</th>
         <th>N°topic</th>
         </tr>";

    
foreach ($data as $row){
        $id_data = $row["ID_TOPIC"];
        echo "<tr>
         <td>" . $row["ID_USER"] . "</td>
         <td>" . $row["PSEUDO_USER"] . "</td>
         <td>" . $row["ID_CATEGORY"] . "</td>
        <td><input type='checkbox' value=" . $id_data . " name='id_data[]'></td>
         </tr>";
}
echo "</table>";
echo "<input type='submit' id='btn_del' value='Supprimer' name='delete' formaction = 'delete_topic.php'>";

echo "</form>";    
