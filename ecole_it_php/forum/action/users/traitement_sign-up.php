<?php
require("../forum/action/connection_BDO.php");



// validation de formulaire 

if (isset($_POST["sign-up"])) {
   
    
    if(isset($_POST["email"]) && isset($_POST["pwd"])) {
    
//  recuperatuion des donnes de utilisteur
        
        $email = $_POST["email"];
        $password = $_POST["pwd"];
       
// requete  de verification si utilisateur existe deja ou non
        $requete = $bdd->prepare('SELECT * FROM inscription WHERE EMAIL=:email') ;
        $requete->execute(array('email'=>$email));
        $result = $requete->fetch() ;
        
 // dans le cas ou requete recupere rien
        if (!$result) {
            $msg_pwd= "please enter a valid email address";
 // dans le cas ou il trouve utilisteur mais il na pas confirme son inscription
        }elseif ($result["COMPTE_VALIDATE"] == 0) {

        require("../forum/includes/token.php");

        $requete_update = $bdd->prepare("UPDATE inscription SET TOKEN_USER=:token WHERE EMAIL=:email");
        $requete_update->bindValue(":token", $token);
        $requete_update->bindValue(":email", $_POST["email"]);
        $requete_update->execute() ;
        require_once"../forum/includes/PHPMailer/sendmail.php";
        $msg_email= "your account is not confirmed another email from you will be resent to you please confirmed ";
// dans le cas ou il le trouve et la deja confirme son inscription
        }else{
//je verifie si le password coressepend
        $password_is_ok = password_verify($_POST['pwd'],$result['PWD']);
// si la condition verifie etablisement de la connection  
        if ($password_is_ok ) {

            $msg='vous etes connecte';
            session_start();
            $_SESSION['role'] = $result['FROLE'];
            $_SESSION['ID_USER'] = $result['ID_USER'];
            $_SESSION['auth'] = true;
            $_SESSION['email'] = $email  ;
            $_SESSION['pseudo'] = $result['PSEUDO'];
            
           
            var_dump($result['FROLE']);
// si utilisteur coche se souvenir de moi 
            if (isset($_POST['rember_me'])) {
                setcookie('email', $_POST['email'], time()+ 3600*24*365) ;
                setcookie('password', $_POST['pwd'], time()+ 3600*24*365) ;
// si utulisteur ne coche rien   
            }else{
// si une cookie existe deje on lui attribue  une valeur nul
                if(isset($_COOKIE['email'])){
                    setcookie( $_COOKIE['email'], "") ;
                }
                if (isset($_COOKIE['pwd'])){
                  setcookie( $_COOKIE['pwd'],"");
                } 
            }   

            header('location:index.php');
            
        }else{
                $msg_pwd="your password is not valid ";

            }

        }
    }
}
?>