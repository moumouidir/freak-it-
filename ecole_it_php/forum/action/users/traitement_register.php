<?php 
require(__DIR__."/../connection_BDO.php");


// insertion du fichier qui permer la connection a la base de donnés

//  les differentes verification
if (isset($_POST["sent"])) {




            if (empty($_POST["pseudo"]) || !ctype_alnum( $_POST['pseudo'])) {
                $error_msg =  'votre pseudo doit etre une chaine de caractere alphanumerique  ';
            }elseif (empty($_POST['fname']) || !ctype_alpha($_POST['fname']    )) {
                $error_msg = 'votre nom doit contenir une chaine caractere alphabetique';
            }elseif (empty($_POST['firstname']) ||!ctype_alpha ($_POST['firstname'] )) {
            $error_msg = 'votre firstname doit etre une chaine caracteres alphabetiques';
            }elseif (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error_msg = 'please insert in email valide';
            }elseif (empty($_POST['pwd']) || $_POST['pwd'] != $_POST['confirm_pwd']) {
                $error_msg = 'insert password validate or the password and password in not macth';
            }elseif (empty($_POST['date'])) {
                $error_msg = 'please insert date';
            }elseif (empty($_POST['description'])|| !htmlspecialchars($_POST['description'])) {
                $error_msg = "le champs est baniere est vide ";
            
        
            } else { 
// selection des utilisteur qui ont le meme pseudo et ou le meme email
                    $req_search_user_exist = $bdd->prepare('SELECT * FROM  inscription WHERE PSEUDO=:pseudo OR EMAIL=:email ');
                    $req_search_user_exist->bindValue(':pseudo', $_POST['pseudo']);
                    $req_search_user_exist->bindValue(':email', $_POST['email']);
                    $req_search_user_exist->execute();
                    $result = $req_search_user_exist->fetch();
                    
        
                    

                    if ($result) {
                      $error_msg = " your pseudo already exist ! or  the email already exists for another pesudo !!!";
                    }else{
                        // insertion a la base de donnes

                            require_once"/wamp64/www/ecole_it_php/forum/includes/token.php";
                            $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
                            $req_register_user_bdd = $bdd->prepare('INSERT INTO inscription(PSEUDO,FNAME,FIRSTNAME,EMAIL,PWD,FDATE,FROLE,TOKEN_USER,PHOTO,FDESCRIPTION)
                            VALUES(:pseudo,:fname,:firstname,:email,:pwd,:fdate,:frole,:token,:photo_profil,:banner)');

                            // correspendance 
                            $req_register_user_bdd->bindvalue(':pseudo',$_POST['pseudo']);
                            $req_register_user_bdd->bindvalue(':fname',$_POST['fname']);
                            $req_register_user_bdd->bindvalue(':firstname',$_POST['firstname']) ;
                            $req_register_user_bdd->bindvalue(':email',$_POST['email']);
                            $req_register_user_bdd->bindvalue(':pwd',$pwd);
                            $req_register_user_bdd->bindvalue(':fdate',$_POST['date']);
                            $req_register_user_bdd->bindvalue(':frole',$_POST['role']) ;
                            $req_register_user_bdd->bindvalue(':token',$token) ;
                            $req_register_user_bdd->bindvalue(':banner',$_POST['description']) ;


                            // processus de upload photo et verification
                            require_once("upload.php");
                            $req_register_user_bdd->execute();  
                            require_once"includes\PHPMailer\sendmail.php";    
                        }                                  
                    }   
}
?>