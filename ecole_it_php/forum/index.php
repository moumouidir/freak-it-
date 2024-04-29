<?php
require(__DIR__ . "/action/connection_BDO.php");
require("includes/bar_nav_forum.php");




$requete_publication = $bdd->prepare("SELECT s.ID_TOPIC, s.TITLE, s.ID_CATEGORY, s.PSEUDO_USER, s.DATE_CREATE, m.CONTENU, m.ID_M, i.PHOTO
  FROM sujets AS s
  INNER JOIN messages AS m ON s.ID_TOPIC = m.ID_TOPIC
  INNER JOIN inscription AS i ON s.ID_USER = i.ID_USER
  ORDER BY s.DATE_CREATE DESC");
$requete_publication->execute();
$publications = $requete_publication->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil du forum</title>
    <link rel="stylesheet" href="./assets/style_home.css">
</head>

<body>
    <div class="contenair">
        <h1 id="titre_accueil">Welcome in Forum FreakIT  !</h1>

        <div class="pub">
            <?php foreach ($publications as $value) {

                $title_pub = htmlspecialchars($value['TITLE']);
                $pseudo_publis = htmlspecialchars($value['PSEUDO_USER']);
                $date_create = htmlspecialchars($value['DATE_CREATE']);
                $content_message = htmlspecialchars($value['CONTENU']);
                $id_m = htmlspecialchars($value['ID_M']);
                $photo = $value['PHOTO'];
                
            ?>
                <div class="div_publish">
                    <h2>Posted by : <?php if (isset($pseudo_publis)) {
                                        echo  $pseudo_publis;
                                    } ?></h2>

                    <div class="div_img">
                        <a href="Myprofil.php"><?php if (isset($photo)) echo "<img width='70' height='70' class='info' src='$photo'></center>"; ?></a>

                    </div>


                    <p class="author"> Title : <?php if (isset($title_pub)) {
                                                    echo  $title_pub;
                                                } ?></p>
                    <p class="date"> time of creation of the post : <?php if (isset($date_create)) {
                                                                        echo  $date_create;
                                                                    } ?></p>
                    <p class=message>Message n°:<?php if (isset($id_m)) {
                                                    echo  $id_m;
                                                } ?></p>
                    <p class=content>Content : <?php if (isset($content_message)) {
                                                    echo  $content_message;
                                                } ?></p>
                    <div class=responces>
                     <?php if (isset($id_m)) {echo "<a id='reponces' href='article.php?article=$id_m'>Repondre </a>";}?>
                     </div>
                </div>






            <?php } ?>
        </div>
    </div>
</body>

</html>
<footer>
    <p>Copyright &copy; 2024 FreakIT</p>
</footer>