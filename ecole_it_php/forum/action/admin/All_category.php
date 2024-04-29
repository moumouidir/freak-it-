<?php

require('../connection_BDO.php');
require('../users/security_login.php');
require('bar_nav_forum.php');




$req =$bdd->prepare('SELECT ID_CATEGORY,NAME_CATEGORY FROM categories');
$req->execute();
$data =$req->fetchAll();


echo "<link rel=' stylesheet' href='../../assets/style_Allcategory.css'>";


echo "<form      method='POST'>
        <table class ='tab'>
        <tr>
         <th>ID_CATEGORY</th>
         <th>NAME_CATEGORY</th>
         </tr>";

    
foreach ($data as $row){
        $id_data = $row["ID_CATEGORY"];
        echo "<tr>
         <td>" . $row["ID_CATEGORY"] . "</td>
         <td>" . $row["NAME_CATEGORY"] . "</td>
        <td><input type='checkbox' value=" . $id_data . " name='id_data[]'></td>
         </tr>";
}
echo "</table>";
echo "<input type='submit' id='btn_del' value='Supprimer' name='delete' formaction = 'delete_category.php'>";

echo "</form>";    


?>