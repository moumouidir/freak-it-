<?php



require('../connection_BDO.php');
require('../users/security_login.php');
require('bar_nav_forum.php');

if(!isset($_POST['delete'])){

    $error_msg = 'veuiller selectioner la categorie a supprime';
}else{

    foreach($_POST['id_data'] as $value) {

        $req = $bdd->prepare('DELETE FROM categories WHERE ID_CATEGORY = :id_category');
        $req->bindParam(':id_category', $value);
        $req->execute();

        header('location: All_category');
    }
}
?>
