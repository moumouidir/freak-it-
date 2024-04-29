<?php
require("includes/bar_nav_forum.php");
require("action/users/security_login.php");
require("action/connection_BDO.php");

if (isset($_GET['edit_profil']) and isset($_SESSION['ID_USER']) and $_GET['edit_profil'] == $_SESSION['ID_USER']) {

//  verfications et recuperation de id 

    $id_user = $_SESSION['ID_USER'];

    $req = "SELECT * FROM inscription WHERE ID_USER=$id_user";
    $result = $bdd->query($req);
    $ligne = $result->fetch(PDO::FETCH_ASSOC);
//recuperation des donnes dans tableau 
    $pseudo = $ligne['PSEUDO'];
    $banniere = $ligne['FDESCRIPTION'];
    $picture = $ligne['PHOTO'];

    if (isset($_POST['edit'])) {

//verfication des nouvelle informations saisi par user
        if (empty($_POST["pseudo"]) || !ctype_alnum($_POST['pseudo'])) {
            $error_msg =  'votre pseudo doit etre une chaine de caractere alphanumerique  ';
        } elseif (empty($_POST['description']) || !htmlspecialchars($_POST['description'])) {
            $error_msg = "the field is banner is empty ";
        } else {
//je verfie nien qui sagit de nouvelle information pas de ancienne
            $req_search_user_exist = $bdd->prepare('SELECT * FROM  inscription WHERE PSEUDO=:pseudo');
            $req_search_user_exist->bindValue(':pseudo', $_POST['pseudo']);

            $req_search_user_exist->execute();
            $result = $req_search_user_exist->fetch();
            if ($result) {
                $error_msg = " your pseudo already exist !  please insert  an another pesudo !!!";

//  requete de mise a jour 
            } else {
                $req_update = $bdd->prepare("UPDATE inscription SET PSEUDO=:pseudo,FDESCRIPTION=:fdescription,PHOTO=:photo_profil WHERE ID_USER=:id_user ");
                $req_update->bindValue(":pseudo", $_POST["pseudo"]);
                $req_update->bindValue(":fdescription", $_POST["description"]);
                $req_update->bindValue(":id_user", $id_user);
//mise en place de mise de processus de mise a jour dev la photo 
                if (empty($_FILES['photo_profil']['name'])) {
                    $req_update->bindValue(':photo_profil', $picture);
                } else {
                    if (preg_match("#jpeg|png|jpg#", $_FILES['photo_profil']['type'])) {
//verfication du type de photo 
                        $photo_name = $_FILES['photo_profil']['name'];
                        $extension = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
                        $name_generat = md5(uniqid());
                        $new_name_image = "img_profil/$name_generat.$extension";

//stocker dans le dossier images 
                        move_uploaded_file($_FILES['photo_profil']['tmp_name'],$new_name_image);
                    } else {
                        $error_msg = "the profile photo must be of type jpeg or png, jpg ";
                    }
                    $req_update->bindValue('photo_profil', $new_name_image);
                }
        
                $result1 = $req_update->execute();
// execution de requete 
                if ($result1) {
                    header('location:Myprofil.php');
                } else {
                    $error_msg = 'your profile has not been updated ';
                }
            }
        }
    }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/edit_profil.css">
        <title>Edit profil</title>
    </head>


    <body>
        <div class="contenair">
            <form class="forum_reg" method="POST" enctype="multipart/form-data" »>
                <legend>Edit profil </legend>

                <br>
                <br>
                <h2> <?php if (isset($error_msg)) {
                            echo  $error_msg;
                        } ?></h2>

                <div class="data">
                    <label for="Pseudo"> Pseudo : </label>
                    <input type="text" name="pseudo" placeholder="please insert Pseudo" value="<?= $pseudo ?>" maxlength="33" minlength="2" >
                </div>

                <div class="data">
                    <?php echo "<img width='70' class='img' src='$picture' alt='my picture'>"; ?>

                    <label for="photo-profil">Photo de profil : </label>
                    <input type="file" name="photo_profil" id="photo-profil" accept="image/png, image/jpeg" max-size="4000000">

                    <div class="data">
                        <label for="banner">Banner:</label>
                        <input type=text name="description" id="text_banner" value="<?= $banniere ?>" cols="62" rows="2">
                    </div>

                    <div class="btn">
                        <input type="submit" id="btn_register" value="edit" name="edit">
                    </div>

            </form>
        </div>
    </body>
<?php
}
?>

    </html>