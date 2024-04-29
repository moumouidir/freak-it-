<?php

if (isset($_POST['se_souvenir_pwd'])){

// je verfie si il le champ est  vide et c est adresse valable
    if (empty($_POST['email'])||!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){


        $error_msg= 'please inssert a validate adresse mail';
    }else{
// 

        require('action/connection_BDO.php');
        $requete =$bdd->prepare('SELECT * FROM inscription WHERE EMAIL=:email');
        $requete->bindValue(':email', $_POST['email']);
        $requete->execute();
        $result = $requete->fetch();
        $nombre = $requete->rowCount();
        if ($nombre== 0){
            $error_msg= 'adresse saisi ne correspont a aucun membre ';
           
        }else{
                if ($result['COMPTE_VALIDATE'] !=1){
                    require_once('../forum/includes/token.php');

                    $update=$bdd->prepare('UPDATE inscription SET TOKEN_USER=:token WHERE EMAIL=:email');
                    $update->bindValue(':token', $token);
                    $update->bindValue(':email', $_POST['email']);
                    $update->execute();
                    require_once('../forum/includes/PHPMailer/sendmail.php');
                }else{
        // si utilisteur a deja valide son compte 
                    require_once('../forum/includes/token.php');
                    $update=$bdd->prepare('UPDATE inscription SET TOKEN_USER=:token WHERE EMAIL=:email');
                    $update->bindValue(':token', $token);
                    $update->bindValue(':email', $_POST['email']);
                    $update->execute();
                    require_once('../forum/includes/PHPMailer/sendmail_reinis.php');

                    }


             }


        
    }
}