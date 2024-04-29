<?php
require("action/users/security_login.php");
require("action/connection_BDO.php");


if (isset($_SESSION['ID_USER'])) {
    $req_del= $bdd->prepare('DELETE FROM inscription WHERE ID_USER = :id_USER');
    $req_del->bindParam(':id_USER', $_SESSION['ID_USER']);
    $result=$req_del->execute();

    if($result){
        if ($_SESSION) 
        session_unset();
        session_destroy();
        header('location:index.php');
    }
    




}

?>