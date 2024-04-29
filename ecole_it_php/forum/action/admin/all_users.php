<?php

require('../connection_BDO.php');
require('../users/security_login.php');
require('bar_nav_forum.php');




$req =$bdd->prepare('SELECT * FROM inscription');
$req->execute();
$data =$req->fetchAll();


echo "<link rel=' stylesheet' href='../../assets/style_Allcategory.css'>";


echo "<form       method='POST'>
        <table class ='tab'>
        <tr>
         <th>ID_USER</th>
         <th>PSEUDO</th>
         <th>EMAIL</th>
         </tr>";

    
foreach ($data as $row){
        $id_data = $row["ID_USER"];
        echo "<tr>
         <td>" . $row["ID_USER"] . "</td>
         <td>" . $row["PSEUDO"] . "</td>
         <td>" . $row["EMAIL"] . "</td>
        <td><input type='checkbox' value=" . $id_data . " name='id_data[]'></td>
         </tr>";
}
echo "</table>";
echo "<input type='submit' id='btn_del' value='Supprimer' name='delete' formaction = 'delete_user.php'>";

echo "</form>";    

