<?php



require('../connection_BDO.php');
require('../users/security_login.php');


if(!isset($_POST['delete'])){

    $error_msg = 'veuiller selectioner la categorie a supprime';
}else{

    foreach($_POST['id_data'] as $value) {

        $req = $bdd->prepare('DELETE FROM inscription WHERE ID_USER = :id_USER');
        $req->bindParam(':id_USER', $value);
        $req->execute();

        header('location: all_users.php');
    }
}
?>
