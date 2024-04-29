<?php



require('../connection_BDO.php');
require('../users/security_login.php');


if(!isset($_POST['delete'])){

    $error_msg = 'veuiller selectioner le topic a supprime';
}else{

    foreach($_POST['id_data'] as $value) {

        $req = $bdd->prepare('DELETE FROM sujets WHERE ID_TOPIC = :id_TOPIC');
        $req->bindParam(':id_TOPIC', $value);
        $req->execute();

        header('location: ../admin/all_topic.php');
    }
}
?>
