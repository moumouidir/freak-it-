<?php session_start();
require_once("./action/connection_BDO.php");


if (isset($_SESSION['ID_USER'])) {
    // si je suis connecte je recupere id
    $id = $_SESSION['ID_USER'];
    //requete pour recuperer mes donnes  
    $requete = "SELECT * FROM inscription WHERE ID_USER =$id";
    $result = $bdd->query($requete);
    $ligne = $result->fetch(PDO::FETCH_ASSOC);
    //stocker mes des dans variables
    $pseudo = $ligne['PSEUDO'];
    $name = $ligne['FNAME'];
    $firstname = $ligne['FIRSTNAME'];
    $date = $ligne['FDATE'];
    $banner = $ligne['FDESCRIPTION'];
    $email = $ligne['EMAIL'];
    $picture = $ligne['PHOTO'];

} else {
    // dans le cas ous on est pas connectes    
    echo  "<script type=\"text/javascript\">alert('pour acceder a votre profil vous devez etre connecte');
        document.location.href='/ecole_it_php/forum/sign-up';
        </script>";
}

?>
<?php
require("./includes/bar_nav_forum.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/style_profil.css">
    <title>FreakIT Forum - Profil</title>
</head>

<body>

    <section id=titre>
        <h3>FreakIT Forum Profil</h3>
    </section>

    <main>
        <div class="container">
            <h4>Profil de Profil : <?php if (isset($name) && isset($firstname)) {
                                        echo $name . " " . $firstname;
                                    } ?></h4>

            <div class="infos" id="info">
                <?php if (isset($picture)) echo "<center><img width='250' height='250' class='info' src='$picture'></center>"; ?>

                <ul>
                    <li><?php if (isset($pseudo)) echo " Pseudo : " . $pseudo; ?> </li>
                    <li><?php if (isset($email)) echo " Adresse e-mail : " . $email; ?></li>
                    <li><?php if (isset($date)) echo "Date de naissance : " . $date; ?></li>

                    <li><?php if (isset($banner)) echo " Ma banniere : " . $banner; ?></li>
                </ul>
            </div>


            <div class="modifications">
                <?php if (isset($id)) {echo "<a class='modifications' href='edit_profil.php?edit_profil=$id'>Edit Profil </a>";}?>
                <a href="./publish_question.php">Publish an article</a>
                <a href="./delete_profil.php">Delete Profil</a>
                
            </div>
        </div>
    </main>

    <footer>
        <p>Copyright &copy; 2024 FreakIT</p>
    </footer>

</body>

</html>