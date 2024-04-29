<?php
require(__DIR__ . "/action/connection_BDO.php");
require("action/users/security_login.php");
require("includes/bar_nav_forum.php");

$message_id = $_GET['article'];


$requete_message = $bdd->prepare("SELECT s.ID_TOPIC, s.TITLE, m.CONTENU, i.PSEUDO
    FROM sujets AS s
    INNER JOIN messages AS m ON s.ID_TOPIC = m.ID_TOPIC
    INNER JOIN inscription AS i ON s.ID_USER = i.ID_USER
    WHERE m.ID_M = ?");
$requete_message->execute([$message_id]);
$message = $requete_message->fetch();

$pseudo=$message['PSEUDO'];
$id_topic= $message['ID_TOPIC'];
$title_topic= $message['TITLE'];
var_dump($title_topic);
$id_user=$_SESSION['ID_USER'];
if (!$message) {
    header("Location: home.php"); 
    exit;
}


if (isset($_POST['ansewer'])) {
    if(!empty($_POST['answers_description'])) {
        $response_content = htmlspecialchars($_POST['answers_description']);

    
        $insert_response = $bdd->prepare("INSERT INTO messages (ID_TOPIC, CONTENU, ID_USER, DATE_CREATE) VALUES (?, ?, ?, NOW())");
        $insert_response->execute([$id_topic, $response_content,$id_user ]);

        header("Location: home.php?id=" . $id_topic);  
    }else {
            $error_msg="please complete the champs";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respond to Message</title>
    <link rel="stylesheet" href="./assets/style_responce.css">
</head>

<body>
    <div class="contenair">
        <h2>Respond to: <?php if (isset($pseudo)) { echo  $pseudo;}?></h2>

        <div class="message">
            <p class="author"> TITLE :  <?php if (isset($title_topic)) { echo  $title_topic;} ?></p></p>
            <p class="author">N° Topic: <?php if (isset($id_topic)) { echo  $id_topic;} ?></p>
            <p class="content">content of the publication :<?php echo htmlspecialchars($message['CONTENU']); ?></p>
            <br>
            <p id="error"><?php  if(isset($error_msg)) {echo  $error_msg ; }?></p>
        </div>

        <form method="POST" action="">
            <textarea name="answers_description" placeholder="Enter your response here"  cols="70" row= "40"></textarea>
            <br>
            <input id="btn_answer" type="submit" value="ansewer" name="ansewer">
        </form>
    </div>
</body>

</html>
