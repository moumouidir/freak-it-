<?php

require("../connection_BDO.php");


if(isset($_GET["email"]) && !empty($_GET["email"])
 && $_GET["token"] && !empty($_GET["token"])) {
$email = $_GET["email"];
$token = $_GET["token"];

$requete = $bdd->prepare('SELECT * FROM inscription WHERE EMAIL=:email AND TOKEN_USER=:token') ;
$requete->bindValue(':email', $email) ;
$requete->bindValue(':token', $token) ;

$requete->execute() ;
$number= $requete->rowCount() ;

if($number== 1) {

    $requete_update = $bdd->prepare('UPDATE inscription SET COMPTE_VALIDATE=:valide,TOKEN_USER=:token WHERE EMAIL=:email') ;
    
    $requete_update->bindValue(':email', $email) ;
    $requete_update->bindValue(':token', "compte active");
    $requete_update->bindValue(':valide',1) ;

    $result_update = $requete_update->execute() ;

    if($result_update) {
        echo"<script type=\"text/javascript\">alert('thank you, now your email address is confirmed');
        document.location.href='/ecole_it_php/forum/sign-up';
        </script>";
    }
}
}





























?>
