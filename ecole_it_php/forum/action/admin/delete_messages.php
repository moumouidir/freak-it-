<?php



require('../connection_BDO.php');
require('../users/security_login.php');


if(!isset($_POST['delete'])){

    $error_msg = 'veuiller selectioner la messages  a supprime';
}else{

    foreach($_POST['id_data'] as $value) {

        $req = $bdd->prepare('DELETE FROM messages WHERE ID_M =:id_M');
        $req->bindParam(':id_M', $value);
        $req->execute();

        header('location: all_messages.php');
    }
}
?>
