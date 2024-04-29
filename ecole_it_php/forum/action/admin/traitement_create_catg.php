
<?php

require('../connection_BDO.php');
require('../users/security_login.php');



if (isset($_POST["create_category"])) {

    if (!empty($_POST['category'])){
        $category = htmlspecialchars($_POST['category']);
    // d'abord  je verifie si la categoru existe deja dans base donnes

    $req_search_category_exist = $bdd->prepare('SELECT * FROM  categories WHERE NAME_CATEGORY=:category');
    $req_search_category_exist->bindValue(':category',$_POST['category']);
    $req_search_category_exist->execute(array(':category'=>$_POST['category']));
    $result = $req_search_category_exist->fetch();
   
    if ($result) {
    // dans le cas ou la categorie existe 
        $error_msg = " cette gategory existe deja !!!";
        $id_categories = $result['ID_CATEGORY'];
        
        } else {
    //  dans le cas ou elle existe pas je fais une insertion 
            $requete=$bdd->prepare('INSERT INTO categories(NAME_CATEGORY)VALUES(:category)');
            $requete->bindValue(':category',$category);
            $requete->execute();
            $result1= $requete->fetch();
            
        }       
        
    }else {
        $error_msg= "please insert a character string";
    }
 
}



