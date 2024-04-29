<?php

require('bar_nav_forum.php');
require('../connection_BDO.php');



session_start();
if (isset($_SESSION['ID_USER'])) {
  $id_connect = $_SESSION['ID_USER'];

      $req=$bdd->prepare('SELECT FROLE FROM inscription WHERE ID_USER=?');
      $req->execute(array($id_connect));
      $result=$req->fetch(PDO::FETCH_ASSOC);

      $role=$result['FROLE'];
      if ($role=="user" ){
        echo  "<script type=\"text/javascript\">alert('to access of  this page si reserved for administrateur');
              document.location.href='/ecole_it_php/forum/home.php';
              </script>";
        die;      
      }
      if($role== "admin"){
        
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
        
      }
    } else {
      // Redirection vers la page de connexion si non connecté ou non admin
      header('Location: /ecole_it_php/forum/sign-up');
      exit();
  }



?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Panel d'administration du forum</title>
  <link rel="stylesheet" href="../../assets/style_admin.css">
</head>
<body>

<section id="titre">
<h2>Name of Profil : <?php if (isset($name) && isset($firstname)) {
                                        echo $name . " " . $firstname;
                                    } ?></h2>
    </section>

    <main>
        <div class="container">
        <?php if (isset($picture)) echo "<center><img class='img'  width='250' height='250' class='info' src='../../$picture'></center>"; ?>

            <div class="info" id="info">
                <ul>
                    <li><?php if (isset($pseudo)) echo " Pseudo : " . $pseudo; ?> </li>
                    <li><?php if (isset($email)) echo " Adresse e-mail : " . $email; ?></li>
                    <li><?php if (isset($date)) echo "Date de naissance : " . $date; ?></li>
                    <li><?php if (isset($banner)) echo " Ma banniere : " . $banner; ?></li>
                    <li><?php if (isset($role)) echo " Role : " . $role; ?></li>
                </ul>
            </div>
            
        </div>

      <aside class="panel"> 
        <h4>Panel d'administration du forum</h4>
        <ul>
          <li><a href="../../delete_profil.php">Delete Profil</a></li>
          <li><a href="all_users.php">Users</a></li>
          <li><a href="all_topic">topic</a></li>
          <li><a href="all_messages">Messages</a></li>
          <li><a href="all_category">Catégories</a></li>
          <li><a href="category_creation.php">create a category</a></li>
          <li><a href="privilege.php">role assignment</a></li>
        </ul>
      </aside>
    </div>
    </main>

    <footer>
        <p>Copyright &copy; 2024 FreakIT</p>
    </footer>






</body>
</html>
