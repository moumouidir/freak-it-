<?php require("../admin/bar_nav_forum.php");?>

<?php

if (isset($_GET["email"])&& !empty($_GET["email"])&& isset($_GET["token"])&& !empty($_GET["token"])) {
// je verfie si token a pu vraiment ete transfere et mail
        $email=$_GET["email"];
        $token=$_GET["token"];
      
// s assuer que que utilisateur existe deja dans bdd et token 
        require_once("../connection_BDO.php");
        $requete=$bdd->prepare("SELECT * FROM inscription WHERE EMAIL=:email AND TOKEN_USER=:token");
        $requete->bindValue(":email",$email);
        $requete->bindValue(":token",$token);
        $requete->execute();
        $nombre= $requete->rowCount();
// il me retourne le nombre utilisteur
        


        if ($nombre!=1) {
            header("location:../forum/sign-up.php");

        }else{
            if (isset($_POST['validate_pwd'])){
                
//  je verifie si il bien remplie les champs et convenablement

                                                if (empty($_POST['pwd'])|| $_POST["pwd"] != $_POST["confirm_pwd"]) {
                                                    $error_msg= "please insert password valide  ";
                                                    }else{

                                                        $pwd =password_hash($_POST["pwd"],PASSWORD_DEFAULT);
//  je mettre a jour le mot de passe 
                                                        $req=$bdd->prepare("UPDATE inscription SET PWD=:pwd WHERE EMAIL=:email");
                                                        $req->bindValue(":pwd",$pwd);
                                                        $req->bindValue(":email",$email);
                                                        $req->execute();
                                                        $result =$req->execute();
                                                        var_dump($result);
                                                        if ($result) {
                                                            echo"<script type =\"text/javascript\">
                                                            alert('votre mot de passe  a bien ete reinitialisé!');
                                                            document.location.href='../../sign-up.php';
                                                            </script>"; 
                                                        }else{
                                                            header("location:../password.php");
                                                        }
                                            
                                                    }
                                        
                                            }

             }
    }else{
           header('location:../password.php');
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/style_new_password.css">
    <title>New password</title>
</head>
<body>
    <form class=general_pwd   method="POST" enctype="multipart/form"> 
        <div class="pwd_forget">
        
        <H3> <?php  if(isset($error_msg)) {echo  $error_msg ; }?></H3>
       
        <label for=" password "> New Password : </label>
        <input type="password" name = "pwd" placeholder="please insert password" maxlength="33" minlength="8"   >
    

        <label for="confirm_pwd">Password Confirmation: </label>
        <input type="password" name="confirm_pwd" placeholder=" password Confirmation ">
   

        
        <a href="../sign-up.php">Retun to Login</a>
        <input  id=btn_rest_pwd  type="submit"  value="valider" name = "validate_pwd">
       
        </div>



    </form>
</body>
</html>